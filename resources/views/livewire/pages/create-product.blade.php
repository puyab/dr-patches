<?php

use function Livewire\Volt\{layout, state, usesFileUploads};

usesFileUploads();

layout('layouts.root');

state([
    'type' => '',
    'borderColor' => '#111',
    'textColor' => '#111',
    'backgroundColor' => '#111',
    'text' => '',
    'patchWidth' => 50,
    'patchHeight' => 50,
    'quantity' => 50,
    'patchType' => '',
    'backingType' => '',
    'amount' => 1,
])->url();

$setType = fn(string $type) => $this->type = $type;


?>

<div class="py-10 flex flex-col items-center justify-center">
    @if(!$this->type)
        <div class="w-full h-max flex flex-col items-center justify-center py-10 gap-6 px-8 text-center">
            <h1 class="text-black font-bold text-2xl md:text-3xl lg:text-4xl">How you want to create your patch?</h1>
            <p class="text-black font-medium text-xl md:text-2xl">You can choose between the two method that we offer to
                customers for creating a custom patch</p>
        </div>
        <div class="w-full h-max flex flex-col items-center justify-center gap-8 md:flex-row">
            <div
                wire:click="setType('image')"
                class="w-[300px] h-[300px] bg-black hover:bg-primary-1 rounded-xl transition-all duration-100 cursor-pointer text-primary-1 hover:text-white flex flex-col items-center justify-center gap-4 px-3 text-center">
                <x-fas-image class="w-24 aspect-auto"/>
                <span class="font-bold text-3xl">Image</span>
                <p class="font-medium text-lg">You can create your custom patch with the image you want</p>
            </div>
            <div
                wire:click="setType('text')"
                class="w-[300px] h-[300px] bg-black hover:bg-primary-1 rounded-xl transition-all duration-100 cursor-pointer text-primary-1 hover:text-white flex flex-col items-center justify-center gap-4 px-3 text-center">
                <x-fas-a class="w-24 aspect-auto"/>
                <span class="font-bold text-3xl">Text</span>
                <p class="font-medium text-lg">You can create your custom patch with the text you want</p>
            </div>
        </div>
    @else
        <div
            class="w-11/12 mx-auto h-max max-w-[1620px] bg-black border-primary-1 border-2 py-10 px-8 rounded-xl grid grid-cols-1 lg:grid-cols-4 gap-10">
            <div
                class="bg-primary-1 text-black relative flex flex-col items-center justify-start gap-6 py-10 px-6 rounded-xl lg:col-span-2 overflow-hidden">
                @if($type === 'image')
                    <span class="font-bold text-3xl">Image</span>
                    <div @click="$refs.image.click()"
                         class="w-full h-[300px] border-black border-2 rounded-xl flex flex-col items-center justify-center gap-6 transition-all duration-200 hover:bg-black hover:text-white cursor-pointer">
                        <x-fas-image class="w-10 h-10"/>
                        <span class="font-medium text-xl">Select your image</span>
                    </div>
                    <input type="file" accept="image/*" hidden x-ref="image"/>
                @else
                    <div class="w-full h-max flex flex-col gap-4">
                        <span class="font-bold text-3xl">Text</span>
                        <livewire:inputs.default wire:model="text" label=""/>
                    </div>
                    <div class="w-full h-max flex flex-col gap-4">
                        <span class="font-bold text-3xl">Colors</span>
                        <div class="w-full h-max grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                            <livewire:inputs.color name="border_color" label="Border" :color="$this->borderColor"
                                                   wire:model.live="borderColor"/>
                            <livewire:inputs.color name="text_color" label="Text" :color="$this->textColor"
                                                   wire:model.live="textColor"/>
                            <div class="w-full h-max md:col-span-2">
                                <livewire:inputs.color name="background_color" label="Background"
                                                       :color="$this->backgroundColor"
                                                       wire:model.live="backgroundColor"/>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div
                class="bg-primary-1 text-black relative flex flex-col items-start justify-start gap-6 py-10 px-6 rounded-xl lg:col-span-2 overflow-hidden">
                <span class="font-bold text-3xl">Patching Options</span>
                <livewire:inputs.number :step="1" label="Patch Width" unit="Millimeters" wire:model="patchWidth"/>
                <livewire:inputs.number :step="1" label="Patch Height" unit="Millimeters" wire:model="patchHeight"/>
                <livewire:inputs.number :step="1" label="Quantity" wire:model="quantity"/>
                <livewire:inputs.patch-type wire:model="patchType"/>
                <livewire:inputs.backing-type wire:model="backingType"/>
            </div>
            @if($this->type === "text")
                <div
                    class="bg-primary-1 text-black relative flex flex-col items-center justify-center gap-6 py-10 px-6 rounded-xl lg:col-span-1 overflow-hidden"
                >
                    <span class="font-bold text-3xl">Preview</span>
                    <div class="w-max h-max relative" style="background-color: {{$this->backgroundColor}}">
                        <img class="w-32 aspect-auto" src="{{$this->patchType}}"/>
                        <div class="w-max h-max  absolute inset-0 m-auto"><span class=""
                                                                                style="color: {{$this->textColor}}">{{$this->text}}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div
                data-alone="@json($this->type === 'image')"
                class="bg-primary-1 text-black relative flex flex-col lg:flex-row items-center justify-between gap-6 py-10 px-6 rounded-xl data-[alone=true]:lg:col-span-4 lg:col-span-3 overflow-hidden"
            >
                <span class="font-bold text-3xl">{{$this->type === 'image' ? 'Image' : 'Custom Text'}} Patch</span>
                <div class="w-full h-max flex flex-col items-center justify-center gap-6 lg:flex-row lg:max-w-[500px]">
                    <livewire:inputs.number :step="1" wire:model="amount"/>
                    <span class="font-semibold text-2xl">3,555$</span>
                    <div class="w-[249px] h-max">
                        <x-button>Add to cart</x-button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
