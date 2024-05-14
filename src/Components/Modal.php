<?php

declare(strict_types=1);

namespace App\Http\Livewire\Ugc;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;

class Modal extends Component
{
    public string $displayStyle = 'display: none;';
    public ?UgcTranslation $ugcModel = null;
    public array $ugc = [];
    public string $field;
    public bool $locked;
    public Model $model;

    protected $listeners = ['saveTranslations', 'openUgcModal', 'closeUgcModal'];

    public function mount()
    {
        $this->ugcModel = $this->model->ugcAll($this->field);
        $this->locked = (bool) $this->ugcModel?->locked ?? false;
        $this->ugc = $this->ugcModel?->content ?? [];
    }

    public function render(): View
    {
        return view('vendor.ugc.modal');
    }

    public function updatedUgc($value, $name): void
    {
        $this->ugc[$name] = $value;
    }

    public function saveTranslations(): void
    {
        $json = json_encode($this->ugc);

        $this->ugcModel->content = $json;
        $this->ugcModel->locked = $this->locked;

        $this->ugcModel->save();

        $this->closeUgcModal();
    }

    public function openUgcModal()
    {
        $this->displayStyle = 'display: block';
    }

    public function closeUgcModal()
    {
        $this->displayStyle = 'display: none';
    }
}
