@props([
    'options' => [],
    'selectedItems' => []
])

<div wire:ignore>
    <select x-data="{
        tomSelectInstance: null,
        options: {{ collect($options) }},
        items: {{ collect($selectedItems) }},
 
        renderTemplate(data, escape) {
            return `
                <div><span class='block font-medium text-gray-700'>${escape(data.title)}</span></div>`;
        },
        itemTemplate(data, escape) {
            return `<div>
                <span class='block font-medium text-gray-700'>${escape(data.title)}</span>
            </div>`;
        }
    }" x-init="tomSelectInstance = new TomSelect($refs.input, {
        valueField: 'id',
        labelField: 'title',
        searchField: 'title',
        options: options,
        items: items,
        @if (! empty($items) && ! $attributes->has('multiple'))
            placeholder: undefined,
        @endif
        render: {
            option: renderTemplate,
            item: itemTemplate
        }
    });" x-ref="input" x-cloak {{ $attributes }} placeholder="Pick some links..."></select>
</div>