@foreach($categories[0]->childrenRecursive as $category)
    <div class="accordion-item filters-inner">
        <h2 class="accordion-header" id="heading-{{ $category->categoryId }}">
            <div class="d-flex justify-content-between align-items-center accordion-button collapsed px-3 py-2">
                <span
                    class="filters"
                    data-category-id="{{ $category->categoryId }}"
                    style="cursor: pointer;"
                >
                    {{ $category->categoryName }} ({{ $category->products->count() }})
                </span>

                @if ($category->childrenRecursive->count())
                    <span
                        class="toggle-icon"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $category->categoryId }}"
                        aria-expanded="false"
                        aria-controls="collapse-{{ $category->categoryId }}"
                        style="cursor: pointer;"
                    >
                        +
                    </span>
                @endif
            </div>
        </h2>

        @if ($category->childrenRecursive->count())
            <div id="collapse-{{ $category->categoryId }}" class="accordion-collapse collapse"
                 aria-labelledby="heading-{{ $category->categoryId }}">
                <div class="accordion-body ps-3">
                    @include('partials.category-accordion', ['categories' => $category->childrenRecursive])
                </div>
            </div>
        @endif
    </div>
@endforeach



<script>

    $(document).on('click', '.filters', function () {
        const categoryId = $(this).data('category-id');
        console.log('Load products for categoryId:', categoryId);
        // Fetch products here
    });

</script>

<style>
    .toggle-icon{
        cursor: pointer;
        font-size: 30px;
        font-family: 'gilroy-regularuploaded_file';
    }


    .filters-inner .accordion-button::after{
       display: none;
    }

</style>
