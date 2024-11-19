<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Actions\Concerns\InteractsWithRecord;
use Filament\Forms\Form;
use App\Utils\GenerateQrCode;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;


class CreateCustomer extends CreateRecord
{
    use HasWizard;

    protected static string $resource = CustomerResource::class;
    protected ?string $heading = 'Client';

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    /** @return Step[] */
    protected function getSteps(): array
    {
        return [
            Step::make('Details du client')
                ->schema([
                    Section::make()->schema(CustomerResource::getDetailsFormSchema())->columns(),
                ]),

            Step::make('Détails de la voiture')
                ->schema([
                    Section::make()->schema([
                        CustomerResource::getItemsRepeater(),
                    ]),
                ]),
        ];
    }
}
