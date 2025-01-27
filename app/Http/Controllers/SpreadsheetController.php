<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Student;

class SpreadsheetController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->input('data');
        $filename = 'export.xlsx';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Preencher com os dados
        foreach ($data as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $cell = chr(65 + $colIndex) . ($rowIndex + 1); // Converte o índice da coluna para letra e define a linha
                $sheet->setCellValue($cell, $value);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename);
    }

    public function read($filename)
    {
        $spreadsheet = IOFactory::load($filename);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        return response()->json($sheetData);
    }

    public function exportStudents()
    {
        $students = Student::with('category')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Definir os cabeçalhos das colunas
        $headers = ['ID', 'Nome', 'Data de Nascimento', 'Categoria', 'Classe', 'Matrícula', 'Escola', 'Imagem'];
        foreach ($headers as $colIndex => $header) {
            $cell = chr(65 + $colIndex) . '1'; // Converte o índice da coluna para letra (A, B, C, ...)
            $sheet->setCellValue($cell, $header);
        }

        // Preencher os dados dos estudantes
        foreach ($students as $rowIndex => $student) {
            $rowIndex += 2; // Ajustar a linha de início dos dados
            $sheet->setCellValue('A' . $rowIndex, $student->id);
            $sheet->setCellValue('B' . $rowIndex, $student->name);
            $sheet->setCellValue('C' . $rowIndex, $student->date_of_birth);
            $sheet->setCellValue('D' . $rowIndex, $student->category->name); // Utiliza o nome da categoria
            $sheet->setCellValue('E' . $rowIndex, $student->class);
            $sheet->setCellValue('F' . $rowIndex, $student->student_id);
            $sheet->setCellValue('G' . $rowIndex, $student->school);
            $sheet->setCellValue('H' . $rowIndex, $student->image);
        }

        $filename = 'students_export.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename);
    }
}