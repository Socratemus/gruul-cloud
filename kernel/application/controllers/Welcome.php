<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
        
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{   
            $this->load->database();
            $query = $this->db->get('templates', 2, 0);
            
            $html = '<html><head><meta charset="UTF-8" /><title>PHPWord</title></head><body>';
            $html .= $query->result()[0]->content;
            $html .= '</body></html>';
            //echo $html;die;
            $output_folder = $this->config->config['word_output_folder'];
            if(!$output_folder) {
                throw new Exception("Outout folder configuration not set");
            }
                
            if(!file_exists($output_folder)) {
                mkdir($output_folder, 0777, true);
            }
                
            $html_path = "fuckaryisthis.html";
            file_put_contents($html_path, $html);
            
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($html_path, 'HTML');
            $phpWord->setDefaultParagraphStyle(array('space' => array('line' => 300), 'spaceAfter' => 0, 'spaceBefore' => 0));
            $phpWord->setDefaultFontName('Times New Roman');
            $phpWord->setDefaultFontSize(10);
            
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            
            $filename = $output_folder . date('His') . md5(uniqid()) . '.docx';
            $objWriter->save( $filename );
            unlink($html_path);
            die($filename);
            $this->load->view('welcome_message');
	}
}
