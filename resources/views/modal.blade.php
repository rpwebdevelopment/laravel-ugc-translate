<div>
    <button wire:click.prevent="openUgcModal" style="background-color: #F0F0F0; border: none; border-radius: 4px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="40" fill="#6c757d">
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M0 128C0 92.7 28.7 64 64 64H256h48 16H576c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H320 304 256 64c-35.3 0-64-28.7-64-64V128zm320 0V384H576V128H320zM178.3 175.9c-3.2-7.2-10.4-11.9-18.3-11.9s-15.1 4.7-18.3 11.9l-64 144c-4.5 10.1 .1 21.9 10.2 26.4s21.9-.1 26.4-10.2l8.9-20.1h73.6l8.9 20.1c4.5 10.1 16.3 14.6 26.4 10.2s14.6-16.3 10.2-26.4l-64-144zM160 233.2L179 276H141l19-42.8zM448 164c11 0 20 9 20 20v4h44 16c11 0 20 9 20 20s-9 20-20 20h-2l-1.6 4.5c-8.9 24.4-22.4 46.6-39.6 65.4c.9 .6 1.8 1.1 2.7 1.6l18.9 11.3c9.5 5.7 12.5 18 6.9 27.4s-18 12.5-27.4 6.9l-18.9-11.3c-4.5-2.7-8.8-5.5-13.1-8.5c-10.6 7.5-21.9 14-34 19.4l-3.6 1.6c-10.1 4.5-21.9-.1-26.4-10.2s.1-21.9 10.2-26.4l3.6-1.6c6.4-2.9 12.6-6.1 18.5-9.8l-12.2-12.2c-7.8-7.8-7.8-20.5 0-28.3s20.5-7.8 28.3 0l14.6 14.6 .5 .5c12.4-13.1 22.5-28.3 29.8-45H448 376c-11 0-20-9-20-20s9-20 20-20h52v-4c0-11 9-20 20-20z"/>
        </svg>
    </button>

    <div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 2000; {{ $displayStyle }}">
        <div wire:click.prevent="closeUgcModal" style="display: block; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: black; z-index: 10000; opacity: 0.4;"></div>

        <div style="position: absolute; top: 20vh; padding: 20px; width: 50%; left: 25%; background: #FFFFFF; border-radius: 10px; z-index: 20001;">
            <div style="width: 100%; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 18px; margin-bottom: 0; width: 50%;">
                    Edit "{{ ucfirst($field) }}" Translations
                </h2>

                <label>
                    <input wire:model="locked" style="margin-right: 5px;" name="lock" type="checkbox" />
                    Lock Translations
                </label>
            </div>

            @foreach($model->ugcLanguages as $locale)
                @isset(\RpWebDevelopment\LaravelUgcTranslate\Services\Locale::LOCALE_LANGUAGES[$locale])
                    <h3 style="font-size: 16px; margin-bottom: 5px;">{{ \RpWebDevelopment\LaravelUgcTranslate\Services\Locale::LOCALE_LANGUAGES[$locale] }}:</h3>
                    <textarea
                        style="width: 100%; max-width: 100%; margin-bottom: 20px;"
                        type="text"
                        wire:model.lazy="ugc.{{ $locale }}"></textarea>
                @endisset
            @endforeach

            <div style="width: 100%; text-align: right;">
                <button wire:click.prevent="closeUgcModal" style="background-color: #dd133c; color: #FFFFFF; border: none; border-radius: 4px; padding: 5px 20px;">Close</button>
                <button wire:click.prevent="generateTranslations" style="background-color: #00dec4; color: #FFFFFF; border: none; border-radius: 4px; padding: 5px 20px;">Re-Generate</button>
                <button wire:click.prevent="saveTranslations" style="background-color: #00dec4; color: #FFFFFF; border: none; border-radius: 4px; padding: 5px 20px;">Save</button>
            </div>
        </div>
    </div>
</div>
