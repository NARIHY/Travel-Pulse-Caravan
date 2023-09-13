<?php
namespace Nari\Interface;

interface PdfInterface
{
    /**
     * in this method, we take the user id, the trip id and render them in pdf version like a reservation ticket
     */
    public function generatePDF();
}
