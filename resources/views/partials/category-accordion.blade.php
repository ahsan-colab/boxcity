@foreach($categories[0]['children'] as $category)
    <div class="accordion-item filters-inner">
        <h2 class="accordion-header" id="heading-{{ $category['categoryId'] }}">
            <div class="d-flex justify-content-between align-items-center accordion-button collapsed px-3 py-2">
                <span
                    class="filters"
                    data-category-id="{{  $category['categoryId'] }}"
                    style="cursor: pointer;"
                >
                    {{  $category['categoryName'] }} ({{ $category['totalProductCount'] }})
                </span>
                <span class="remove-filter" style="display: none;">&times;</span>
            </div>
        </h2>
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
