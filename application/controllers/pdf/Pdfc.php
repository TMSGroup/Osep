<?php
// Este es el controlador general de encuestas
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdfc extends CI_Controller{

	function __construct(){
		parent::__construct();

            $this->load->helper('form');
            $this->load->helper('url');

            // modelo de relevamiento
            $this->load->library('Pdf');
            $this->load->model('relevamiento/Relevamiento_model');
            $this->load->model('pdf/Pdf_model');

    }


    function index(){  

    
        // Aqui colocar una proteccion para la redireccion o de sesion
        // el metodo index no se utiliza... en este caso por que necesito el valor del id segment para usarlo como parametro
        redirect('relevamiento/relevamientoC', 'refresh');
        
        
    }


    function printPdf(){
        ob_start();
        $data['nroRelev'] = $this->uri->segment(3);
		// aqui traigo los datos generales del relevamiento
		$data['relevamiento'] = $this->Relevamiento_model->getRelevamiento($data['nroRelev']);

        if( $data['relevamiento'] != false){


            //trae tods los datos de integrantes pertenecientes al mism relevamiento
            $data['encuestados'] = $this->Relevamiento_model->getEncuestados($data['nroRelev']);


            $data['bloques']= $this->Relevamiento_model->obtenerBloques();




          $data['respuestas'] = $this->Pdf_model->getRespuesta_e(2,3,2);

           //var_dump($data['encuestados']->result());
           // var_dump($data['respuestas']);
            // var_dump($data['relevamiento']->result()[0]);
            // var_dump($data['direccion'] );
            //var_dump($data['bloques'] );



                
                //$encuestados = $data['encuestados']->result();
            // ;
        
    // create new PDF document
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Relevamiento_N_22212');
    $pdf->SetSubject('TCPDF Tutorial');
   
    
    
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Israel Parra');
    $pdf->SetTitle('Ejemplo de provincías con TCPDF');
    $pdf->SetSubject('Tutorial TCPDF');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
    $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    

    
    // ---------------------------------------------------------
    
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', 'B', 15, '', true);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    
    $pdf->SetFont('freemono', '', 9);


    //Aqui van las consultas
    $relevamiento = $data['relevamiento']->result()[0]; // consulta de datos de relevamiento la paso a esta variable

    $encuestados= unserialize($relevamiento->cantEncuestados); // deserializo el string y saco la cantidad de integrantes
    
    $direccion= $this->Pdf_model->getDireccion_e($relevamiento->idDireccion); // traigo la direccion a partir del id de direccion 

    $dataB10 = $this->Pdf_model->getRespuesta_e($data['nroRelev'],null,10);
    

    $tbl_relev = 
                '<table cellpadding="4" border="1" >
                <tr>
                    <td colspan="2" bgcolor="#EAEAEA" align="center">Bloque Identificación del Territorio/Facilitador/Familia Relevada</td>
                </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Relevamiento N°</td>
                            <td  align="left">'.$relevamiento->nroRelevamiento.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Facilitador</td>
                            <td  align="left">'.$relevamiento->nombreE .' '.$relevamiento->apellidoE .'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Fecha Relevamiento</td>
                            <td  align="left">'.$relevamiento->fechaRelevamiento.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Criticidad</td>
                            <td  align="left">'.$relevamiento->idCriticidad.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Telefono Titular</td>
                            <td  align="left">'.$relevamiento->telTitular.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Telefono Supervisión</td>
                            <td  align="left">'.$relevamiento->telSup.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Cantidad Encuestados</td>
                            <td  align="left">'.$encuestados['cantidad'].'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Cantidad Encuestados</td>
                            <td  align="left">'.$encuestados['cantidad'].'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Observaciones Iniciales</td>
                            <td  align="left">'.$relevamiento->observacion.'</td>
                        </tr>
                        
                </table>';

        $pdf->writeHTML($tbl_relev, true, false, false, false, '');



        $tbl_direccion = 
                '<table cellpadding="4" border="1" >
                <tr>
                    <td colspan="2" bgcolor="#EAEAEA" align="center">Direccion</td>
                </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Calle</td>
                            <td  align="left">'.$direccion->calle.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Numero</td>
                            <td  align="left">'.$direccion->numero.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Barrio</td>
                            <td  align="left">'.$direccion->barrio.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Manzana / Casa</td>
                            <td  align="left">'.$direccion->manzana. ' / '.$direccion->casa.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Localidad</td>
                            <td  align="left">'.$direccion->descloc.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Departamento</td>
                            <td  align="left">'.$direccion->descdep.'</td>
                        </tr>
                        <tr>
                            <td bgcolor="#F7F7F7" align="center">Codigo Postal</td>
                            <td  align="left">'.$direccion->cploc.'</td>
                        </tr>

                        
                </table>';
        $pdf->writeHTML($tbl_direccion, true, false, false, false, '');
        

// dibujar bloque 10 vivienda y entorno


    //encabezado de tabla
    $tbl_bloque10= '<table cellpadding="4" border="1" >
                        <tr>
                            <td colspan="2" bgcolor="#EAEAEA" align="center">Vivienda y Entorno</td>
                        </tr>';
                
                foreach($dataB10 as $item){

                    $tbl_bloque10.='
                    
                        <tr>
                        <td bgcolor="#F7F7F7" align="center">'.$item[0].'</td>
                        <td  align="left">'.$item[1].'</td>
                        </tr>
                    
                    ';
                }
    
    //cierre de tabla
    $tbl_bloque10.= '</table>';


    $pdf->writeHTML($tbl_bloque10, true, false, false, false, '');  
            
            $encuestados= $this->Relevamiento_model->getEncuestados($data['nroRelev']);
            var_dump($encuestados->result());
            $tbl_integrantes = '<h1>Integrantes</h1>
        
            ';
            



               foreach($encuestados->result() as $item){  // inicio bucle de encuestados de este relevamiento


                $tbl_integrantes .= '
                <table cellpadding="4" border="1" >
                <tr>
                    <td bgcolor="#F7F7F7" align="center">Nombre </td>
                    <td  align="left">'.$item->nombreEncuestado.'</td>
                </tr>
                <tr>
                    <td bgcolor="#F7F7F7" align="center">Apellido </td>
                    <td  align="left">'.$item->apellidoEncuestado.'</td>
                </tr>            
                <tr>
                    <td bgcolor="#F7F7F7" align="center">DNI </td>
                    <td  align="left">'.$item->dniEncuestado.'</td>
                </tr>            
                <tr>
                    <td bgcolor="#F7F7F7" align="center">Edad </td>
                    <td  align="left">'.$item->edad.'</td>
                </tr>            
                <tr>
                    <td bgcolor="#F7F7F7" align="center">Sexo </td>
                    <td  align="left">'.$item->sexo.'</td>
                </tr>            
                <tr>
                    <td bgcolor="#F7F7F7" align="center">Afiliado N° </td>
                    <td  align="left">'.$item->nroAfiliado.'</td>
                </tr>
                </table>
                
                ';

                $pdf->writeHTML($tbl_integrantes, true, false, false, false, '');


                $tbl_integrantes="";


                $respuesta_e= $this->Pdf_model->getRespuesta_e(2,$idEncuestado,2);

                // foreach(){ // inicio bucle de bloques reposndidos por cada encuestado




                // }   // finalizo bucle de bloques de cada encuestado

                   
                    
                }  // finalizo bucle de encuestados de este relevamiento






//echo($tbl_integrantes);

            //$pdf->writeHTML($tbl_integrantes, true, false, false, false, '');
            







            
            $pdf->Output('example_001.pdf', 'I');



        }else{




            echo("el relevamiento no existe   enlace para volver");




        }
        
    }

}