<?php
namespace App\Application\TypeDocument\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeDocument\Enums\TypeDocumentFilterDisplay;
use App\Domain\TypeDocument\Enums\TypeDocumentFilterStatus;

class SearchTypeDocumentDTO
{
    public function __construct(
        public string $Text = "",
        public TypeDocumentFilterDisplay $Display = TypeDocumentFilterDisplay::ALL,
        public TypeDocumentFilterStatus $Status = TypeDocumentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeDocumentFilterDisplay::PUBLIC,
            'PRIVATE' => TypeDocumentFilterDisplay::PRIVATE,
            default => TypeDocumentFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeDocumentFilterStatus::ACTIVE,
            'INACTIVE' => TypeDocumentFilterStatus::INACTIVE,
            default => TypeDocumentFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Display: $display,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}