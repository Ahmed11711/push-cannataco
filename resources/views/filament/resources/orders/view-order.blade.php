<x-filament::page>
    <h1>عرض الطلب رقم: {{ $record->id }}</h1>

    <p>العميل: {{ $record->customer_name }}</p>
    <p>السعر: {{ $record->total }}</p>
</x-filament::page>