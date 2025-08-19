<?php

class DataModel {
    private $dataSources;
    private $visualizations;
    private $integrations;

    public function __construct() {
        $this->dataSources = [];
        $this->visualizations = [];
        $this->integrations = [];
    }

    public function addDataSource($name, $data) {
        $this->dataSources[$name] = $data;
    }

    public function addVisualization($name, $type, $config) {
        $this->visualizations[$name] = [
            'type' => $type,
            'config' => $config
        ];
    }

    public function addIntegration($dataSource, $visualization) {
        $this->integrations[] = [
            'dataSource' => $dataSource,
            'visualization' => $visualization
        ];
    }

    public function generateVisualization($integration) {
        $dataSource = $this->dataSources[$integration['dataSource']];
        $visualization = $this->visualizations[$integration['visualization']];

        switch ($visualization['type']) {
            case 'chart':
                return $this->generateChart($dataSource, $visualization['config']);
            case 'map':
                return $this->generateMap($dataSource, $visualization['config']);
            default:
                return 'Unsupported visualization type';
        }
    }

    private function generateChart($data, $config) {
        // chart generation logic here
        return '<chart>';
    }

    private function generateMap($data, $config) {
        // map generation logic here
        return '<map>';
    }
}

$model = new DataModel();

// sample data
$model->addDataSource('sales', [
    ['category' => 'A', 'value' => 10],
    ['category' => 'B', 'value' => 20],
    ['category' => 'C', 'value' => 30]
]);

$model->addVisualization('bar_chart', 'chart', [
    'xAxis' => 'category',
    'yAxis' => 'value'
]);

$model->addIntegration('sales', 'bar_chart');

echo $model->generateVisualization(['dataSource' => 'sales', 'visualization' => 'bar_chart']);