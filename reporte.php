<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Título del reporte
$sheet->setCellValue('A1', 'Reporte de Ventas');
$sheet->mergeCells('A1:H1'); // Unir celdas para el título
$sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Encabezados de la tabla
$encabezados = ['Empleado', 'Fecha', 'Cliente', 'Nombre del Producto', 'Código', 'Cantidad', 'Precio', 'Total del Producto'];
$sheet->fromArray($encabezados, NULL, 'A2');

// Estilo para el encabezado
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '2307BD']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ]
    ]
];

$sheet->getStyle('A2:H2')->applyFromArray($headerStyle);
$sheet->getRowDimension(2)->setRowHeight(20);

// Cargar datos desde el archivo JSON
$ventas = json_decode(file_get_contents("ventas.json"), true);

$row = 3; // Comienza en la fila 3
foreach ($ventas as $venta) {
    $firstRow = true;
    foreach ($venta['productos'] as $producto) {
        // Solo mostrar datos de empleado, fecha y cliente en la primera fila de la venta
        $sheet->setCellValue('A' . $row, $firstRow ? $venta['empleado'] : '');
        $sheet->setCellValue('B' . $row, $firstRow ? $venta['fecha'] : '');
        $sheet->setCellValue('C' . $row, $firstRow ? $venta['cliente'] : '');
        $sheet->setCellValue('D' . $row, $producto['nombre']);
        $sheet->setCellValue('E' . $row, $producto['codigo']);
        $sheet->setCellValue('F' . $row, $producto['cantidad']);
        $sheet->setCellValue('G' . $row, $producto['precio']);
        $sheet->setCellValue('H' . $row, $producto['total']);
        
        $firstRow = false;
        $row++;
    }
}

// Aplicar bordes y fondo a los datos
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ]
    ],
    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER,
        'horizontal' => Alignment::HORIZONTAL_LEFT,
    ]
];

$sheet->getStyle('A3:H' . ($row - 1))->applyFromArray($dataStyle);

// Establecer tamaño automático para las columnas
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Establecer los encabezados para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_ventas.xlsx"');
header('Cache-Control: max-age=0');

// Guardar el archivo en formato Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
