@foreach($categories as $category)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{ $category->categoryId }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $category->categoryId }}" aria-expanded="false"
                    aria-controls="collapse-{{ $category->categoryId }}">
                {{ $category->categoryName }} ({{ $category->products->count() }})
            </button>
        </h2>

        <div id="collapse-{{ $category->categoryId }}" class="accordion-collapse collapse"
             aria-labelledby="heading-{{ $category->categoryId }}">
            @if ($category->childrenRecursive->count())
                <div class="accordion-body ps-3">
                    @include('partials.category-accordion', ['categories' => $category->childrenRecursive])
                </div>
            @endif
        </div>
    </div>
@endforeach
