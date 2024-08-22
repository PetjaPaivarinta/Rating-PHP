<?php
        require('fpdf.php');

    class PDF extends FPDF
        {
            // Load data
            function LoadData($file)
            {
                // Read file lines
                $lines = file($file);
                $data = array();
                foreach($lines as $line)
                $data[] = explode(',',trim($line));
                return $data;
            }

            // Simple table
            function BasicTable($header, $data)
            {
                 // Column widths
                $w = array(30, 35, 50);
                // Header
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                // Data
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR');
                    $this->Cell($w[1],6,$row[1],'LR');
                    $this->Cell($w[2],6,$row[2],'LR');
                    $this->Ln();
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
            }
        }

        $pdf = new PDF();
        // Column headings
        $header = array('Gender', 'Emoji', 'Time of Day');
        // Data loading
        $data = $pdf->LoadData('ratings.txt');
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->BasicTable($header,$data);
        $pdf->Output();
    ?>