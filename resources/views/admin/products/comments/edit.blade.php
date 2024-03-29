@extends('layouts.main')

@section('page.title', 'Админ панель: Редактирование отзыва')

@section('main.content')
    <div class="container" style="max-width: 960px;">
        <x-title>
            {{ __('Редактирование отзыва о товаре') }}
            <a href="{{ route('admin.products.show', $productId) }}">
                {{ App\Models\Product::query()->findOrFail($productId)->name }}
            </a>

            <x-slot name="right">
                <a href="{{ route('admin.products.comments', $productId) }}">
                    {{ __('Назад') }}
                </a>
            </x-slot>
        </x-title>

        <x-comment.item :comment="$comment" />

        <x-comment.form action="{{ route('admin.products.comments.update', ['product' => $productId, 'comment' => $comment->id]) }}"
                        method="put" :productId="$productId" :comment="$comment">
            <div class="mt-3 text-right">
                <x-button type="submit" class="py-2 px-3" size="sm">
                    {{ __('Сохранить изменения') }}
                </x-button>
            </div>
        </x-comment.form>
    </div>
@endsection
