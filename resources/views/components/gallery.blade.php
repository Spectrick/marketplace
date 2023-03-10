@props(['product', 'images_url'])

<div data-gallery="simple">
    @foreach($images_url as $image_url)
        <figure id="image-{{ $loop->iteration }}">
            @if(str_starts_with($image_url, 'http'))
                <img src="{{ $image_url }}" alt="{{ $product->name }}" class="img-fluid">
            @else
                <img src="{{ '/storage/'.$image_url }}" alt="{{ $product->name }}" class="img-fluid">
            @endif
        </figure>
        @php($img_count = $loop->count)
    @endforeach
    <nav>
        @foreach($images_url as $image_url)
            <a href="#image-{{ $loop->iteration }}">
                @if(str_starts_with($image_url, 'http'))
                    <img src="{{ $image_url }}" alt="{{ $product->name }}" class="col-sm-1">
                @else
                    <img src="{{ '/storage/'.$image_url }}" alt="{{ $product->name }}" class="col-sm-1">
                @endif
            </a>
        @endforeach
    </nav>
</div>

@once
    @push('js')
        <script type="text/javascript" src='/js/jquery.simple-gallery.js'></script>
    @endpush
@endonce
