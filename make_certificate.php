<?php
    // For generating pdf
    require('fpdf/fpdf.php');

    function pixel_to_pt($px)
    {
        return round(0.75*$px);
    }

    function pt_to_pixel($pt)
    {
        return round(4*$pt/3);
    }


    function make_participation_certificate($name, $event)

    {

        $certificate_dimensions = array(pixel_to_pt(1123), pixel_to_pt(794));
          $name_pos = array(pixel_to_pt(220), pixel_to_pt(415));
          $name_size = array(pixel_to_pt(637), pixel_to_pt(0));

          $event_pos = array(pixel_to_pt(420), pixel_to_pt(530));
          $event_size = array(pixel_to_pt(221), pixel_to_pt(23));

          $fecha_pos = array(pixel_to_pt(420), pixel_to_pt(560));
          $fecha_size = array(pixel_to_pt(221), pixel_to_pt(23));

        $certificate_template = "res/participant.png";


        $ciudad= "Quito, ";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date=date('d-m-Y');
        $fecha=$ciudad.$date;

        $certificate = new FPDF("Landscape", "pt", $certificate_dimensions);
        $certificate->AddPage();

        $certificate->Image($certificate_template, 0, 0, $certificate_dimensions[0], $certificate_dimensions[1]);
          $certificate->SetFont("Arial", "", 44);
          $certificate->SetXY($name_pos[0], $name_pos[1]);
          $certificate->Cell($name_size[0], $name_size[1], $name, 0, 0, "C");

          $certificate->SetFont("Arial", "", 24);
          $certificate->SetXY($event_pos[0], $event_pos[1]);
          $certificate->Cell($event_size[0], $event_size[1], $event, 0, 0, "C");

          $certificate->SetFont("Arial", "", 12);
          $certificate->SetXY($fecha_pos[0], $fecha_pos[1]);
          $certificate->Cell($fecha_size[0], $fecha_size[1], $fecha, 0, 0, "C");

        $certificate->Output("I", "certificate.pdf");
    }

        // Main
        if($_POST["name"] or $_POST["event"])
        {
            $name = $_POST["name"];
            $event = $_POST["event"];

            make_participation_certificate($name, $event);

            echo "<h1> Generated certificate </h1>";
            exit();
        }

    ?>
