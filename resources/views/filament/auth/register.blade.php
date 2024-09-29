<div class="bg-[#000000] bg-opacity-100">
    
    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}
    <div class="w-full flex items-center justify-center mb-10">
        <img src="/images/chlorine.png" class="w-32" alt="">
    </div>

    <x-filament-panels::form id="form" wire:submit="register">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
    
    @if (filament()->hasLogin())
    <div class="w-full flex items-center justify-center">
        <div name="subheading" class="w-max">
            {{ __('filament-panels::pages/auth/register.actions.login.before') }}

            {{ $this->loginAction }}
        </div>
    </div>
    @endif
</div>
