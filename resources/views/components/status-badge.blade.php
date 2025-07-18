@props(['status'])

@php
$cor = '';
switch (strtolower($status ?? '')) {
    case 'pendente':
        $cor = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
        break;
    case 'em análise':
        $cor = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
        break;
    case 'aprovado':
        $cor = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
        break;
    case 'concluído':
        $cor = 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        break;
    default:
        $cor = 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200';
}
@endphp

<span {{ $attributes->merge(['class' => 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $cor]) }}>
    {{ $status }}
</span>