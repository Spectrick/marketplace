@extends('layouts.main')

@section('page.title', 'Админ панель: Просмотр отзывов')

@section('main.content')

    <div class="container" style="max-width: 960px;">
        <x-title>
            <h4>
                {{ __('Отзывы о товаре') }}
                <a href="{{ route('products.show', $productId) }}">
                    {{ App\Models\Product::query()->findOrFail($productId)->name }}
                </a>
            </h4>
        </x-title>

        @if (!$comments->isEmpty())
            @foreach($comments as $comment)
                <x-comment.item :comment="$comment" />
            @endforeach
        @else
            <div class="mb-5">
                {{ __('Отзывы к товару в данный момент отсутствуют') }}
            </div>
        @endif

        <x-comment.form action="{{ route('products.comments.store', $productId) }}" method="POST" :productId="$productId">
            <div class="mt-3 text-right">
                <x-button type="submit" class="py-2 px-3" size="sm">
                    {{ __('Отправить отзыв') }}
                </x-button>
            </div>
        </x-comment.form>
    </div>
@endsection

