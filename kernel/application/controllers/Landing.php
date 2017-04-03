<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use \PhpOffice\PhpOffice\PhpWord\Style\Indentation as Indentation;

class Landing extends CI_Controller {
   
	public function index()
	{   
	    $output_folder = $this->config->config['word_output_folder'];
	    
	    $html = '<html><head><meta charset="UTF-8" /><title>PHPWord</title></head><body>';
        $html .= "<h2>Welcome to my generator.</h2><p>This page is going to have a header</p>";
        $html .= '</body></html>';
        
        $html_path = md5('randomstring' . time() .uniqid()) . ".html";
        file_put_contents($html_path, $html);
        
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($html_path, 'HTML');
        
        $phpWord->addFontStyle('myCustomTitleStyle', array('name'=>'HelveticaNeueLT Std Med', 'size'=>16, 'color'=>'990000')); //h1
        
        $phpWord->setDefaultParagraphStyle(array('space' => array('line' => 300), 'spaceAfter' => 0, 'spaceBefore' => 0));
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(10);
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        
        $filename = $output_folder . date('His') . md5(uniqid()) . '.docx';
        
        //======= INSERT HEADER =======//
        $tableStyle = [
            'cellMarginTop' => 25
        ];
        
        $firstRowStyle = array('cellMarginTop' => 25);
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        
        
        $section = $phpWord->getSections()[0];
        $header = $section->addHeader();
        $table = $header->addTable();
        
        $table->addRow();
        $table->addCell(1500)->addImage( getcwd() . '/../public/assets/img/logo.png', array('width'=>75, 'height'=>75, 'align'=>'center'));
        
        $mycell = $table->addCell(4500, [
            'borderBottomSize'  => 5,
            'borderLeftSize'  => 5,
            'spaceBefore' => 50, 'spaceAfter' => 50
        ]);
        
        $mycell->setMarginLeft(15);
        
        $mycell->addText('This is the header.', array('name'=>'HelveticaNeueLT Std Med', 'size'=>16, 'color'=>'990000'));
        $mycell->addText('this is subheader');
        
        
        ;
        
        
        $mycell->getElements()[0]->getFontStyle()->getParagraph()->setIndentation(new \PhpOffice\PhpWord\Style\Indentation(['left' => 155]));
        $mycell->getElements()[1]->getFontStyle()->getParagraph()->setIndentation(new \PhpOffice\PhpWord\Style\Indentation(['left' => 155]));
        
        
        $objWriter->save( $filename );
        
        unlink($html_path);
        
        echo $filename;die;
        
        $this->load->database();
        die('aici este...');    
	}
}
