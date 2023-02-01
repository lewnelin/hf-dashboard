<?php

namespace healthfirst\hfdashboard\services;

use Craft;
use GuzzleHttp\Exception\GuzzleException;
use healthfirst\hfdashboard\models\AccessModel;
use healthfirst\hfdashboard\records\AccessRecord;
use RuntimeException;
use craft\base\Component;
use craft\helpers\App;
use craft\helpers\Json;

class DashboardService extends Component
{

    /**
     * @param $data
     * @return string
     */
    private function sanitizeField($data): string
    {
        return trim(strip_tags($data));
    }

    /**
     * @param $data
     * @return array
     */
    private function saveRecord($data): array
    {
        $model = new AccessModel();
        $record = new AccessRecord();

        foreach ($model->attributes as $key => $value) {
            if (!isset($data[$key])) {
                $record->{$key} = '';
            } else if (is_array($data[$key])) {
                $record->{$key} = Json::encode($data[$key]);
            } else {
                $record->{$key} = $this->sanitizeField($data[$key]);
            }
        }

        return ['result' => $record->save(), 'id' => $record->id];
    }

    /**
     * @param $data
     * @return array
     */
    private function modelData($data): array
    {
        $model = new AccessModel();

        $payload = [];

        /**
         * todo: optimize saveRecord and modelData
         */
        foreach ($model->attributes as $key => $value) {
            if (!isset($data[$key])) {
                $payload[$key] = '';
            } else if (is_array($data[$key])) {
                $payload[$key] = Json::encode($data[$key]);
            } else {
                $payload[$key] = $this->sanitizeField($data[$key]);
            }
        }

        return $payload;
    }

    /**
     * @param $data
     * @param bool $unit
     * @return array|bool[]
     */
    public function processData($data, bool $unit = false): array
    {
        // unit
        if ($unit) {
            return $this->saveRecord($data);
        }

        $record = $this->saveRecord($data);

//        if ($record['result']) {
//
//            // if email sending is active
//            if (App::env('EMAIL_SEND')) {
//                $this->createEmail($data);
//            }
//
//            Queue::push(new FormServerJob([
//                'id' => $record['id'],
//                'data' => $this->modelData($data)
//            ]), 11);
//        }

        return ['success' => true];
    }

    /**
     * @param $data
     * @return bool
     */
    public function sendToFormServer($data): bool
    {
        $client = Craft::createGuzzleClient([
            'defaults' => ['verify' => false],
            'base_uri' => App::env('FS_API_URL') ?? 'https://staging.digitalforms.healthfirst.org'
        ]);
        try {
            $result = $client->post('store-entry/refer', [
                //'debug' => TRUE,
                'form_params' => $data,
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ]
            ]);
        } catch (GuzzleException $e) {
            Craft::error($e->getMessage(), __METHOD__);
            throw new RuntimeException($e->getMessage());
        }

        if ($result->getStatusCode() === 200 &&
            Json::isJsonObject($result->getBody()) &&
            Json::decode($result->getBody())['success']) {

            return true;

            /**
             * todo: save the id from digitalforms
             */
        }

        Craft::error($result->getBody(), __METHOD__);
        throw new RuntimeException($result->getBody());
    }
}
