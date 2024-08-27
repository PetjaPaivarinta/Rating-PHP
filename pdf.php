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
                    $data[] = explode(',', trim($line));
                return $data;
            }

            // Simple table
            function FancyTable($header, $data)
            {
                // Colors, line width and bold font
                $this->SetFillColor(15, 82, 186);
                $this->SetTextColor(255);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Header
                $w = array(40, 35, 60); // Widths for three columns
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],10,$header[$i],1,0,'C',true);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(255,200,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Data
                $fill = false;
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                    $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                    $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
                    $this->Ln();
                    $fill = !$fill;
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
        $pdf->FancyTable($header, $data);
        $pdf->Output();
?>