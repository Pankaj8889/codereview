<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( hello_elementor_display_header_footer() ) {
		if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
			get_template_part( 'template-parts/dynamic-footer' );
		} else {
			get_template_part( 'template-parts/footer' );
		}
	}
}
?>

<?php wp_footer(); ?>
<script>

jQuery(document).ready(function($) {
        // Create the + and - buttons
       function createQuantityButtons() {
            var $minusButton = $('<button class="minus"><i class="fas fa-minus"></i></button>');
            var $plusButton = $('<button class="plus"><i class="fas fa-plus"></i></button>');
            $('.quantity').each(function() {
                if (!$(this).find('.input-text.qty.text').is(':hidden')) {
                    $(this).prepend($minusButton.clone());
                    $(this).append($plusButton.clone());
                }
            });
        }
        createQuantityButtons();
        jQuery(document.body).on('updated_cart_totals', function() {
        	setTimeout(createQuantityButtons, 1000);
		});

        // Button click events
        jQuery('.plus').on('click', function(e) { 
            e.preventDefault();
            var quantityInput = $(this).siblings('input.qty');
            var currentVal = parseInt(quantityInput.val());
            quantityInput.val(currentVal + 1);
            jQuery('.input-text.qty.text').trigger('change');
			if(jQuery('.input-text.qty.text').val() <2){
			}
			else if(jQuery('.input-text.qty.text').val() <3){
				$('input[value="2"]').prop('checked', true);
			}
			else if(jQuery('.input-text.qty.text').val() <=4){
				$('input[value="3"]').prop('checked', true);
			}
			else{
				$('input[value="5"]').prop('checked', true);
			}
        });

        jQuery('.minus').on('click', function(e) {
            e.preventDefault();
            var quantityInput = $(this).siblings('input.qty');
            var currentVal = parseInt(quantityInput.val());
            if (currentVal > 1) {
                quantityInput.val(currentVal - 1);
            }
            jQuery('.input-text.qty.text').trigger('change');
			if(jQuery('.input-text.qty.text').val() <2){
			}
			else if(jQuery('.input-text.qty.text').val() <3){
				$('input[value="2"]').prop('checked', true);
			}
			else if(jQuery('.input-text.qty.text').val() <=4){
				$('input[value="3"]').prop('checked', true);
			}
			else{
				$('input[value="5"]').prop('checked', true);
			}
        });		
    });
		jQuery(window).on('load', function($) {
		jQuery('#top-seller-in-category div.ais-Hits ol.ais-Hits-list, ol.ais-FrequentlyBoughtTogether-list ').slick({
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			autoplay: true,
			responsive: [
				{
					breakpoint: 770,
					settings: {
						slidesToShow: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
		
	});
document.addEventListener('DOMContentLoaded', function() {

    const quantityInput = document.querySelector('.quantity input.input-text.qty');
    const addToCartButton = document.querySelector('.single_add_to_cart_button');
    if (quantityInput) {
        const rows = document.querySelectorAll('.wccs-bulk-pricing-table tbody tr');
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                const minQuantity = this.querySelector('td[data-type="quantity"]').dataset.quantityMin;
                quantityInput.value = minQuantity;
                jQuery('.input-text.qty.text').trigger('change');
                //addToCartButton.click();
            });
        });
    } else {
        console.error("Quantity input field not found.");
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.24.0/dist/algoliasearch-lite.umd.js" integrity="sha256-b2n6oSgG4C1stMT/yc/ChGszs9EY/Mhs6oltEjQbFCQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.74.0/dist/instantsearch.production.min.js" integrity="sha256-1OlwSxFMcBXdQtWWvx95HkDw88ZSOde0gyii+lyOkB4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@8.5.0/themes/reset-min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@8.5.0/themes/satellite-min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
	body
	{
		overflow-x: hidden;
		overflow-y: auto;
	}
    #algolia-header-search-container
    {
        position: absolute;
        overflow: visible;       
        background: white;
        z-index: 99999;
        display: none;        
        scrollbar-width: none;
        top: 0px;
        width:100%;
		height: 100vh;
    }
    #algolia-header-search
    {
        display: flex;
        flex-flow: column nowrap;
		min-height: 0;
		overflow-x: hidden;
		overflow-y: auto;
    }
    ol.ais-Hits-list
    {        
        list-style: none;
    }
     #header-algolia-hits > .ais-Hits> ol
    {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }
    .algolia-products-list > #header-algolia-hits > .ais-Hits> ol > li
    {
        margin: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        border-radius: 15px;
        float: none;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(35, 38, 59, .05), 0 1px 3px 0 rgba(35, 38, 59, .15);
        display: flex;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.25rem;
    }
    .algolia-header-single-product > .woocommerce-loop-product-buttons > a
    {
        background-color: #84ba85 !important;
        font-family: "Josefin Sans", Sans-serif;
        font-weight: 800 !important;
        text-transform: uppercase;
        border-style: solid !important;
        border-width: 1px 1px 1px 1px !important;
        border-radius: 10px 10px 10px 10px !important;
        width: 100%;
        padding: 10px !important;
        color: #fff !important;
        display: inline-block;
        font-size: 11px;
    }
    #algolia-header-search > div
    {
        padding-right: 1.5rem;
        margin-top
    }
    .ais-Hits-list
    {
        padding: 0px;
    }
    .ais-Hits-item > div
    {
        margin-top: 10px;
    }
	li.ais-Hits-item:hover, li.ais-Carousel-item:hover {
		box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.5);
		transform: scale(1.05);
		transition: all 0.3s 0s ease;
	}
	#infinite-products li.ais-Hits-item
	{
		position: relative;
	}
    .algolia-headers-title
    {
        font-weight: 700;
        color: #f79420;
    }
    a.ais-hits--title-link
    {
        color: black;
    }
    div.algolia-categories-list
    {
        width: 25%;
        margin-top: 20px;
    }
    div#algolia-categories > div > ol  , div#posts > div > ol
    {
        display: block !important;
    }
     div#algolia-categories > div > ol > li , div#posts > div > ol > li 
    {
        margin-top:10px !important;
        border: 0px !important;
        padding: 0px !important;
        text-align: unset !important;
        box-shadow: unset !important;
        display: block !important;
		border-radius: unset !important;
    }
    div#algolia-categories > div > ol > li:hover , div#posts > div > ol > li:hover, div#popular-search > div > ol > li:hover
    {
        transform: scale(1.05);
        transition: all 0.3s 0s ease;
    }
    .algolia-header-single-product > a , .algolia-header-single-category > a, .algolia-header-single-post > a
    {
        text-decoration: none;
    }
    div#popular-search > div > ol > li > div > span
    {
        font-size: 14px important;
    }
    div.algolia-products-list
    {
        float: left;
        width: 70%;
    }
    div.algolia-posts-list
    {
        width: 25%;
        float:right;
    }
    .algolia-header-single-product > a >.woocommerce-loop-product-title
    {
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #54595f;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        min-height: 33px
    }
    .algolia-header-single-product > a >.ais-hits--thumbnail > img, .fqb-carousel-item img
    {
        height:90px;
        margin-bottom: 1rem;
    }
    .algolia-see-all
    {
        float:right;
    }
    .algolia-header-close
    {
        display: block;
        width: 100%;
        -webkit-box-align: center;
        position: absolute;
        margin-bottom: -2.0rem;
        bottom: 0.5rem;
    }
    button.header-search-close
    {
        display: flex;
        text-align: center;
        justify-content: center;
        flex-direction: row;
        -webkit-box-pack: center;
        -webkit-box-orient: horizontal;
        margin-left: auto;
        margin-right: auto;
        background-image: none;
        border: 0px;
        overflow: visible;
        background: transparent;
    }
    button.header-search-close:hover
    {
        background: transparent;
    }
    .header-search-close > span
    {
        position: absolute;
    }
    @media (min-width: 767px) and (max-width: 99999px) {
        .sticky-buttons
        {
            display: none;
        }
    }
    @media (max-width: 767px) {
        #algolia-header-search-container
        {
            flex-flow: column nowrap;
            min-height: 0;
            overflow: hidden;
            position: fixed;
        }
        .algolia-header
        {
            padding: 0px !important;
        }
        .algolia-header-logo
        {
            display:none !important;
        }
        .algolia-before-results
        {
            display:none !important;
        }
        #algolia-header-search
        {
            flex-wrap: wrap;
        }
        .algolia-results-wrapper
        {
            padding-left:8px !important;
            padding-right:8px !important;

        }
        #header-ais-facets
        {
            position: fixed;
            top: 0;
            width: 100% !important;
            height: 100%;
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 2px 0 5px rgba(0, 0, 0, .3);
            transition: left .3s ease;
            overflow: auto;
            z-index: 999;
            margin: 32px 0 0 !important;
            display:none;
            padding: 10px;
        }
        .mobile-filter-button
        {
            align-items: center;
            border-radius: 10px;
            display: flex;
            flex: 1 0 0;
            font: var(--bds-typography-functional-button-200);
            justify-content: center;
            padding: 5px;
            border-color: black;
        }
        .algolia-categories-list
        {
            order: 2;
        }
        .algolia-products-list
        {
            order: 1;
        }
        .algolia-posts-list
        {
            order: 3;
        }
        .m-full
        {
            width:100% !important;
        }
        .algolia-products-list > #header-algolia-hits > .ais-Hits> ol
        {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        .alg-toggle-filters-button
        {
            display: block !important;
            left: 50%;
            transform: translateX(-50%);
            position: absolute;
            bottom: 24px;
            z-index: 1;
            box-shadow: 0px 6px 20px rgba(49, 36, 133, .15);
            background-color: #84ba86 !important;
            border-color: #84ba86;
            color: white !important;
            border-radius: 50rem;
        }
        button.alg-toggle-filters-button > svg
        {
            fill: white;
        }
        #header-ais-facets.open {
            left: 0;
            display: block;
        }
        .sticky-buttons
        {
            background: linear-gradient(180deg, transparent 0, #fff 40px, #fff);
            margin-bottom: -12px;
            padding-bottom: max(env(safe-area-inset-bottom), 32px);
            padding-top: 40px;
            bottom: 0;
            display: flex;
            gap: 16px;
            margin-top: auto;
            position: sticky;
            z-index: 4;
        }
        div.algolia-posts-list
        {
            margin-top: 20px;
            padding: 20px;
        }
		.ais-LookingSimilar-list
		{
			grid-template-columns: repeat(2, 1fr) !important;
		}
		#rcmnd-products
		{
			padding-left: 10px !important;
    		padding-right: 10px !important;
		}
        
    }
    .algolia-search-results
    {
        height: 100% !important;
        max-height: 100%;
        overflow-y: auto;
        position: relative;
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px 24px;
        width: 100%;
        padding: 0;
        margin: 0;
        overflow: hidden;
    }
    .algolia-header
    {
        display: grid;
		grid-template-columns: min-content 1fr min-content;
		padding: 10px 48px 0px;
		gap: 12px;
		align-items: end;
    }
    #searchbar{
        grid-column: 2;
        border-bottom: 1px solid #84ba86;
        position: relative;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        padding: 0;
        margin: 0;
        background-color: #fff;
        border: 0;
        height: 48px;
        line-height: 48px;
    }
    .algolia-header-logo{
        /* min-width: 48px;
        
        max-height: 48px; */
        max-width: 144px !important;
        align-self: center;
        cursor: pointer;
        display: block;
    }
    .searchbox-icon
    {
        flex: 0 0 auto;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        gap: 4px;
    }
    .searchbox-main
    {
        flex: 1 1 auto;
        position: relative;
    }
    #header-algolia-input {
        appearance: none;
        position: relative;
        z-index: 1;
        display: block;
        min-width: 0;
        width: 100% !important;
        height: 100% !important;
        border-width: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        background: none !important;
    }
    .algolia-close-button{
        grid-column: 3;
        align-self: center;
    }
    .algolia-close-button:hover
    {
        color: black;
    }
    #popular-search
    {
        grid-column: 1;
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        align-content: space-between;
        padding: 0;
        gap: 8px;
		padding: 0px 50px;		
    }
    div#popular-search > div > ol
    {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        align-content: space-between;
        padding: 0;
        gap: 8px;
    }
    div#popular-search > div > ol > li
    {
        flex: none;
        display: inline-flex;
        position: relative;
        vertical-align: middle;
        background-color: rgba(0, 0, 0, 0);
        border: 1px solid #75787a;
        border-radius: 50rem;
        padding: 0px !important;
        transition: var(--dfd-btn-transition, color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out);
    }
    .algolia-guided-filter-content
    {
        flex: 1 1 auto;
        width: auto;
        overflow: hidden;
    }
    .algolia-brand-slider
    {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }
    .brand-slider
    {
        flex: 1 1 auto;
        padding: 4px;
        overflow-x: scroll;
        scrollbar-width: none;
    }
    .slider-nav-button
    {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 0 0 auto;
        width: 24px;
        overflow: hidden;
        margin: 4px;
        cursor: pointer;
        opacity: 1;
        transition: opacity .125s ease-in;
    }
    .algolia-header-single-category
    {
        flex: 1 1 auto;
        padding-left: 12px;
        align-items: center;
        display: inline-flex;
        height: 30px;
        margin: 0px !important;
        padding-right: 12px;
    }
    .guided-filters
    {
		display: none !important;
        margin: 0 48px 10px 48px;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.05));
        border-radius: 8px;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
        padding: 5px 25px;
        overflow: hidden;
        overscroll-behavior: contain;
        background-color: var(--df-neutral-background, hsl(204, 2%, 100%));
        border: 1px solid var(--df-neutral-outline, hsl(204, 2%, 80%));
        cursor: default;
    }
	#algolia-trending-items
    {
        margin-bottom: 0px !important;
    }
    .slick-dots
    {
        display:none !important;
    }
    .bold-title
    {
        font-weight: bold;
    }
    .f-14
    {
        font-size:14px;
    }
    .algolia-results-wrapper
    {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-start;
        justify-content: space-between;
        padding-left: 48px;
        padding-right: 1.5rem;
    }
    #header-ais-facets
    {
        flex: 0 0 auto;
        margin: 0 24px 48px 0;
        width: 280px;
    }
    #ais-main
    {
        flex: 1 1 auto;
        position: relative;
    }
    ol, li,ul
    {
        list-style: none; 
    }
    #algolia-categories
    {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        gap: 8px;
        position: relative;
        transition: transform 0.3s ease; 
    }
    .category-item
    {
        display: flex;
        flex-direction: row;
        border: 1px solid var(--df-neutral-outline, hsl(204, 2%, 80%));
        border-radius: 4px;
        cursor: pointer;
        flex: 0 0 auto;
        padding: 10px;
    }
    .infinte-listing-checker
    {
        margin-top: -20px;
    }
    button.guided-filters-skip-btn.algolia-buttons
    {
        color: #84ba86;
        padding: 0px;
        height: 38px;
        font-size: 13px;
    }
    .algolia-buttons
    {
        background-color:#00000000 !important;
        border: 0px;
    }
    button.guided-filters-skip-btn.algolia-buttons.brand-close
    {
        position: absolute;
        top: 0;
        right: 0;
        padding: 8px;
    }
    .ais-RefinementList-showMore {
        background-color: #fecc47 !important;
        background-image: unset;
        padding: 15px;
    }
    .widgettitle {
        color: #f79420 !important;
    }
    .alg-toggle-filters-button
    {
        display: none;
    }
    .algolia-backdrop
    {
        opacity: .75;
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 9;
        background-color: #000;
        transition: opacity var(--df-layer-animation-duration) cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .algolia-backdrop.active
    {
        display: block !important;
    }
    #header-sort-by-container
    {
        float:right;
    }
    #algolia-stats
    {
        float:left;
    }
    .algolia-hits-top
    {
        min-height: 40px;
    }
    .ais-RefinementList-checkbox, .ais-GeoSearch-input
    {
        box-shadow: none;
    }
    .ais-RefinementList-labelText
    {
        overflow: unset;
    }
    .algolia-header-single-product
    {
        width: 100%;
    }
    #wpadminbar
    {
        z-index: 9 !important;
    }
    #rcmnd-products
    {
        justify-content: flex-start;
        align-items: stretch;
        flex-flow: row nowrap;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
        overscroll-behavior: contain;
        padding-left: 40px;
        padding-right: 40px;
    }
    #similar-products
    {
        padding: 30px;
    }
    .ais-LookingSimilar-list
    {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
    }
    .ais-LookingSimilar-item
    {
        margin: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        border-radius: 15px;
        float: none;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(35, 38, 59, .05), 0 1px 3px 0 rgba(35, 38, 59, .15);
        display: flex;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.25rem;
    }
	.ais-Carousel-list
    {
        scrollbar-width: none;
    }
	ol.ais-TrendingItems-list .slick-track {
        display: flex;
    }
/* 	ol.ais-TrendingItems-list li {
    	min-width: 181px;
	} */
	li.ais-Carousel-item.ais-TrendingItems-item
    {
        margin: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        border-radius: 15px;
        float: none;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(35, 38, 59, .05), 0 1px 3px 0 rgba(35, 38, 59, .15);
        display: flex;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.25rem;
    }
    li.slick-slide.ais-TrendingItems-item
    {
        margin: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        border-radius: 15px;
        float: none;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(35, 38, 59, .05), 0 1px 3px 0 rgba(35, 38, 59, .15);
        display: flex;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.25rem;
    }
    .ais-TrendingItems-title
    {
        font-weight: 400 !important;
        margin-bottom: 0px !important;
    }
    .ais-Carousel-navigation
    {
        border: unset !important;
        box-shadow: unset !important;
        top:20px !important;
    }
    .ais-Carousel-navigation:hover, .ais-Carousel-navigation:focus
    {
        background-image: unset !important;
        background-color: unset !important;
        border: unset !important;
    }
    .ais-Carousel-navigation--previous, .ais-Carousel-navigation--next
    {
        color: transparent !important;
    }
    .ais-Carousel-navigation--previous:before
    {
        content: '<';
        color: black;
    }
    .ais-Carousel-navigation--next:before
    {
        content: '>';
        color: black;
    }
    .trending-product-image
    {
        height: 70px !important;
    }
    #browse-trending-products .ais-TrendingItems .ais-TrendingItems-title {
        display: none;
    }
    .single-line-text
    {
        margin-bottom: 0px !important;
        min-height: 15px !important;
        -webkit-line-clamp: 1 !important;
    }
    .low-pd
    {
        padding: 5px !important;
    }
    .low-margin
    {
        margin-bottom: 5px !important;
    }
	@media (max-width:767px){
		#header-sort-by-container {
			float: none !important;
		}
	}
	li.ais-RefinementList-item
	{
		margin-bottom: .5rem;
	}
	.trending-carousel-thumbnail
    {
        height: 90px !important;
        text-align: -webkit-center;
        margin-top: 0xp !important;
    }
	.slick-dots
    {
        display:none !important;
    }
	button.slick-next
    {
        border: unset !important;
        box-shadow: unset !important;
        top:20px !important;
    }
    button.slick-next:hover, button.slick-next:focus
    {
        background-image: unset !important;
        background-color: unset !important;
        border: unset !important;
    }
    button.slick-prev, button.slick-next
    {
        color: transparent !important;
    }
    button.slick-prev:before
    {
        content: '<';
        color: black;
    }
    button.slick-next:before
    {
        content: '>';
        color: black;
    }
	.slick-list.draggable {    
        max-width: calc(100% - 80px);
        width: 100% !important;
        margin: 0 auto;
    }
	ol.ais-TrendingItems-list.slick-initialized.slick-slider button.slick-prev.slick-arrow ,ol.ais-TrendingItems-list.slick-initialized.slick-slider button.slick-next  {
	box-shadow: unset !important;
	top: 50% !important;
}
	div#algolia-header-search-container ol.ais-TrendingItems-list.slick-initialized.slick-slider button.slick-next {
        right: 15px;
    }
    div#algolia-header-search-container ol.ais-TrendingItems-list.slick-initialized.slick-slider button.slick-prev.slick-arrow {
        left: 5px;
    }
    .algolia-header div.cart-icon
    {
        display: flex;
        column-gap: 20px;
    }
    button.algolia-close-button.algolia-buttons
    {
        border: 1px solid;
        background-color: green !important;
        color: white;
    }
	.slick-next:before {
    content: url(/wp-content/uploads/2024/10/Frame-84.png) !important;
}
	.slick-prev:before {
    content: url(/wp-content/uploads/2024/10/Frame-85-1.png) !important;
}
	@media screen and (max-width: 600px) {
		.algolia-header {
			margin-top: 10px;
			width: calc(100% - 20px);
		}
		#popular-search {
			display : none;
/* 			padding: 0px 10px; */
		}
	}
#algolia-trending-items ol.ais-TrendingItems-list li.ais-TrendingItems-item {
	min-width: 160px !important;
}
#algolia-trending-items ol.ais-TrendingItems-list .slick-track {
    min-width: -webkit-fill-available;
}
	ol.ais-FrequentlyBoughtTogether-list a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.low-pd , div#top-seller-in-category  a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.low-pd {
    background-color: #84ba85 !important;
    font-family: "Josefin Sans", Sans-serif;
    font-weight: 800 !important;
    text-transform: uppercase;
    border-style: solid !important;
    border-width: 1px 1px 1px 1px !important;
    border-radius: 10px 10px 10px 10px !important;
    width: 100%;
    padding: 10px !important;
    color: #fff !important;
    display: inline-block;
    font-size: 11px;
}
 
ol.ais-FrequentlyBoughtTogether-list  .slick-track , div#top-seller-in-category .slick-track {
    gap : 5px !important;
    display: flex ;
}
.ais-FrequentlyBoughtTogether-list  li , div#top-seller-in-category  li {
    margin: 10px;
    box-sizing: border-box;
       display: flex ;
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
    border-radius: 15px;
    float: none;
    align-items: center ;
    background: #ff !important;
    box-shadow: 0 0 0 1px rgba(35, 38, 59, .05), 0 1px 3px 0 rgba(35, 38, 59, .15);
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.25rem;
 
}
ol.ais-FrequentlyBoughtTogether-list h3 , div#top-seller-in-category  h3 {
     font-size: 14px !important;
     font-weight: 500 !important;
     color: #54595f;
     display: -webkit-box;
     -webkit-line-clamp: 2;
     -webkit-box-orient: vertical;
     overflow: hidden;
     text-overflow: ellipsis;
     white-space: normal;
     min-height: 33px !important;!i;!;
}
ol.ais-FrequentlyBoughtTogether-list  span.price  , div#top-seller-in-category  span.price {
    color: black;
}
ol.ais-FrequentlyBoughtTogether-list span.woocommerce-Price-amount.amount  , div#top-seller-in-category  span.woocommerce-Price-amount.amount{
    color: black;
    font-size: .875rem
} 
div#top-seller-in-category button.slick-next.slick-arrow ,.ais-FrequentlyBoughtTogether-list  button.slick-next.slick-arrow {
    top: 50%  !important;
}
.ais-hits--thumbnail { 
	text-align: -webkit-center;
}
.ais-FrequentlyBoughtTogether--empty
{
	display: none;
}
#algolia-trending-items .slick-slide img {
   
    height: auto;
}
#algolia-trending-items .slick-slider {
    width: 100%;
}
#algolia-trending-items div.ais-Hits ol.ais-Hits-list li {
	min-width: 160px;
}
.bf-discount-badge {
    left: 0px;
    position: absolute;
    top: 0px;
    background: #f7931d;
    color: #fff;
    padding: 10px;
    border-radius: 14px 0px 30px 0px;
}
	#elementor-search-form-703aef8 {
		z-index: 1;
	}
	#header-algolia-pagination .ais-Pagination {
	text-align: center !important;
}
#header-algolia-pagination .ais-Pagination-list {
	display: inline-block !important;
	margin-top: 10px;
}
#header-algolia-pagination li.ais-Pagination-item {
	margin-right: 3px !important;
    margin-left: 3px !important;
}
#header-algolia-pagination .ais-Pagination-link {
	background-color: #a4dbe4 !important;
	padding: 10px !important;
	background-image: unset !important;
}
#header-algolia-pagination .ais-Pagination-item--selected  .ais-Pagination-link {
	background-color: #fecc47 !important
}
</style>
<div id="algolia-header-search-container">
    <div class="algolia-backdrop" id="algolia-backdrop"></div>
    <div class="algolia-search-results">
        <div class="algolia-header">
                <img src="/wp-content/uploads/2020/02/naturesfixlogo-1024x244-1.png" class="algolia-header-logo">
                <div id="searchbar" style="border-bottom: 1px solid #84ba86">
                    <div class="searchbox-icon"><span><svg data-phx-id="m11-df-39lodz2635pxcr57ayzjnomiu4w6snlc" xmlns="http://www.w3.org/2000/svg" class="dfd-icon" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M0 0h24v24H0V0z" fill="none"></path><path d="M15.5 14h-.79l-.28-.27c1.2-1.4 1.82-3.31 1.48-5.34-.47-2.78-2.79-5-5.59-5.34-4.23-.52-7.79 3.04-7.27 7.27.34 2.8 2.56 5.12 5.34 5.59 2.03.34 3.94-.28 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg></span>
                    </div>
                    <div class="searchbox-main">
                        <input clas="algolia-search" id="header-algolia-input" />
                    </div>
                </div>
                <div class="cart-icon"><?php echo do_shortcode('[xoo_wsc_cart]'); ?> <button type="button" class="algolia-close-button algolia-buttons" aria-label="Close">X</button>
                </div>
                
            </div>
		<div id="popular-search"></div>
        <div id="algolia-header-search">
            <!-- <div class="algolia-before-results">
                <div class="guided-filters">
                    <div class="algolia-guided-filters-header">
                        <span class="header-filters-title bold-title">    
                            Need help?                    
                        </span>
                        <span class="header-guided-filters-subtitle f-14">                    
                            Filter by <strong>Categories</strong>                    
                        </span>
                        <button class="guided-filters-skip-btn algolia-buttons" type="button">
                            Skip filter →
                        </button>
                    </div>
                    <div class="algolia-guided-filter-content m-full">
                        <div class="algolia-brand-slider">
                            <button class="nav-button prev algolia-buttons slider-nav-button">&lt;</button>
                            <div id="algolia-categories" class="brand-slider"></div>                            
                            <button class="nav-button next algolia-buttons slider-nav-button">&gt;</button>
                        </div>
                        
                    </div>
                    <button type="button" class="guided-filters-skip-btn algolia-buttons brand-close">X</button>
                </div>
            </div> -->
			<div class="algolia-before-results">
                <div class="guided-filters">
                    <div class="algolia-guided-filter-content m-full">
                        <div class="algolia-brand-slider">
                            <!-- <button class="nav-button prev algolia-buttons slider-nav-button">&lt;</button> -->
                            <div id="algolia-trending-items" class="brand-slider"></div>                            
                            <!-- <button class="nav-button next algolia-buttons slider-nav-button">&gt;</button> -->
                        </div>  
                        
                    </div>
                    <button type="button" class="guided-filters-skip-btn algolia-buttons brand-close">X</button>
                </div>
            </div>
            <div id="ais-wrapper" class="algolia-results-wrapper">
                <aside id="header-ais-facets">
                    <div class="filters">
                        <div class="filter-label"><span class="widgettitle"><?php esc_html_e( 'Categories', 'wp-search-with-algolia' ); ?></span></div>
                        <section class="ais-facets" id="header-facet-categories"></section>
                    </div>
                    <div class="filters">
                        <div class="filter-label"><span class="widgettitle"><?php esc_html_e( 'Brands', 'wp-search-with-algolia' ); ?></span></div>
                        <section class="ais-facets" id="header-facet-brands"></section>
                    </div>
                    <div class="filters">
                        <div class="filter-label"><span class="widgettitle"><?php esc_html_e( 'Allergen Information', 'wp-search-with-algolia' ); ?></span></div>
                        <section class="ais-facets" id="header-facet-allergen"></section>
                    </div> 
					<div class="filters">
                        <div class="filter-label"><span class="widgettitle"><?php esc_html_e( 'Discount(in %)', 'wp-search-with-algolia' ); ?></span></div>
                        <section class="ais-facets" id="header-facet-discount"></section>
                    </div>
                                  
                    <div class="filters">
                        <div class="filter-label"><span class="widgettitle"><?php esc_html_e( 'Pricing', 'wp-search-with-algolia' ); ?></span></div>
                        <section class="ais-facets" id="header-facet-pricing"></section>
                    </div>
                    
                    <div class="filters">
                        <div id="clear-refinements"></div>
                    </div>
                    <div class="sticky-buttons">
                        <button class="mobile-filter-button cancel-button">Close</button>
                        <button class="mobile-filter-button view-items-button">View Items</button>
                    </div>                   
                </aside>
                <main id="ais-main">
                    <div class="algolia-products-list m-full">
                        <div class="algolia-hits-top">
                            <div id="algolia-stats"></div>
                            <div id="header-sort-by-container"></div>
                        </div>
                        <!-- <span class="algolia-right-view-all"><a href="#" class="algolia-see-all">See All Products</a></span> -->
                        <div id="header-algolia-hits"></div>
                        <div id="header-algolia-pagination"></div>                        
                    </div>
                    <div class="algolia-posts-list m-full"> 
                        <span class="algolia-headers-title">Blogs</span>
                        <div id="posts"></div>
                    </div>
                </main>
            </div>
            <button type="button" class="alg-toggle-filters-button" id="toggle-filters-button">
                    <svg data-phx-id="m10-df-ga8ygr03kyv6b7dg5rojfmh0vw3oxew0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 18c0 .55.45 1 1 1h5v-2H4c-.55 0-1 .45-1 1zM3 6c0 .55.45 1 1 1h9V5H4c-.55 0-1 .45-1 1zm10 14v-1h7c.55 0 1-.45 1-1s-.45-1-1-1h-7v-1c0-.55-.45-1-1-1s-1 .45-1 1v4c0 .55.45 1 1 1s1-.45 1-1zM7 10v1H4c-.55 0-1 .45-1 1s.45 1 1 1h3v1c0 .55.45 1 1 1s1-.45 1-1v-4c0-.55-.45-1-1-1s-1 .45-1 1zm14 2c0-.55-.45-1-1-1h-9v2h9c.55 0 1-.45 1-1zm-5-3c.55 0 1-.45 1-1V7h3c.55 0 1-.45 1-1s-.45-1-1-1h-3V4c0-.55-.45-1-1-1s-1 .45-1 1v4c0 .55.45 1 1 1z"></path>
                    </svg>
                Filters 
            </button>
            
    </div>
    <div id="rcmnd-products" style="display: none;">
        <div>
            <h3><b>Try again with other search terms...</b></h3>
            <div id="similar-products"></div>
        </div>                  
    </div>
</div>
<script type="text/html" id="tmpl-header-instantsearch-hit">
    <article itemtype="http://schema.org/Article">
        <div class="algolia-header-single-product">
            <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
            <# if ( data.featured_image ) { #>
                <div class="ais-hits--thumbnail">
                    <img src="{{ data.featured_image }}" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
                </div>
            <# } #>
                <h3 class="woocommerce-loop-product-title" itemprop="name headline">{{{ data._highlightResult.post_title.value }}}</h2>
                <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span>
				<# if(data.sale_price) { #> {{{ data.sale_price }}} <# } else { #> {{{ data.actual_price }}} <# } #>
	</b></bdi></span></span>
            </a>
            <div class="woocommerce-loop-product-buttons"><a href="?add-to-cart={{data.post_id}}" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_{{data.post_id}}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="{{data.post_id}}" data-product_sku="{{data.post_id}}" aria-label="Add to basket: “{{data.post_title}}”" rel="nofollow">Add to basket</a></div>
            <?php
            do_action( 'algolia_instantsearch_after_hit' );
            ?>
        </div>
        <div class="ais-clearfix"></div>
        
    </article>
</script>
<script type="text/html" id="tmpl-header-instantsearch-posts">
    <article itemtype="http://schema.org/Article">
        <div class="algolia-header-single-post">
            <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
                <span class="algolia-blog-title" itemprop="name headline">{{{ data.post_title }}}</span>
            </a>
        </div>
        <div class="ais-clearfix"></div>        
    </article>
</script>
<script type="text/html" id="tmpl-header-instantsearch-categories">
    <div class="algolia-header-single-category">
        <a href="{{ data.permalink }}" title="{{ data.name }}" class="ais-hits--title-link" itemprop="url">
            <span class="algolia-category-title" itemprop="name headline">{{{ data.name }}}</span>
        </a>
    </div>
    <div class="ais-clearfix"></div>
</script>
<script type="text/html" id="tmpl-header-instantsearch-popular-search">
    <div class="algolia-header-single-category">
        <span class="algolia-popular-title" data-query="{{ data.query }}" itemprop="name headline">{{{ data.query }}}</span>
    </div>
    <div class="ais-clearfix"></div>
</script>
	
	<script type="text/html" id="tmpl-header-trending-hit">
        <div class="algolia-header-single-product trending-carousel-item">
            <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
            <# if ( data.featured_image ) { #>
                <div class="ais-hits--thumbnail trending-carousel-thumbnail">
                    <img src="{{ data.featured_image }}" class="trending-product-image low-margin" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
                </div>
            <# } #>
                <h3 class="woocommerce-loop-product-title single-line-text" itemprop="name headline">{{{ data._highlightResult.post_title.value }}}</h2>
                <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span><# if(data.sale_price) { #> {{{ data.sale_price }}} <# } else { #> {{{ data.actual_price }}} <# } #></b></bdi></span></span>
            </a>
            <div class="woocommerce-loop-product-buttons"><a href="?add-to-cart={{data.post_id}}" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_{{data.post_id}}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart low-pd" data-product_id="{{data.post_id}}" data-product_sku="{{data.post_id}}" aria-label="Add to basket: “{{data.post_title}}”" rel="nofollow">Add to basket</a></div>
            <?php
            do_action( 'algolia_instantsearch_after_hit' );
            ?>
        </div>
        <div class="ais-clearfix"></div>
</script>
		<script type="text/html" id="tmpl-homepage-latest-products">    
    <div class="algolia-homepage-single-product trending-carousel-item">
        <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
        <# let queryID = localStorage.getItem("algoliaQueryID");
        if ( data.featured_image ) { #>
            <div class="ais-hits--thumbnail homepage-trending-thumbnail">
                <img src="{{ data.featured_image }}" class="trending-product-image low-margin" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
		</div>
        <# } #>
            <h3 class="algolia-homepage-product-title single-line-text" itemprop="name headline">{{{ data._highlightResult.post_title.value }}}</h2>
            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span><# if(data.sale_price) { #> {{{ data.sale_price }}} <# } else { #> {{{ data.actual_price }}} <# } #></b></bdi></span></span>
		</a>
        <div class="algolia-homepage-loop-product-buttons" onClick="sendEventToAlgolia('{{data.objectID}}','{{data.post_title}}','{{queryID}}','conversion')">
			<# if(data.stock_status == 0){ #>
			<a href="{{data.permalink}}" class="button product_type_simple" rel="nofollow">Out Of Stock</a>
			<# } else { #>
			<a href="?add-to-cart={{ data.post_id }}" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_{{ data.post_id }}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="{{ data.post_id }}" data-product_sku="{{ data.post_id }}" aria-label="Add to basket: “{{ data.post_title }}”" rel="nofollow">Add to basket</a>
			<# } #>
			</div>
        <?php
do_action( 'algolia_instantsearch_after_hit' );
        ?>
		</div>
    <div class="ais-clearfix"></div>
	</script>
	<script type="text/html" id="tmpl-homepage-trending-products">    
    <div class="algolia-homepage-single-product trending-carousel-item">
        <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
        <# let queryID = localStorage.getItem("algoliaQueryID");
        if ( data.featured_image ) { #>
            <div class="ais-hits--thumbnail homepage-trending-thumbnail">
                <img src="{{ data.featured_image }}" class="trending-product-image low-margin" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
		</div>
        <# } #>
            <h3 class="algolia-homepage-product-title single-line-text" itemprop="name headline">{{{ data._highlightResult.post_title.value }}}</h2>
            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span><# if(data.sale_price) { #> {{{ data.sale_price }}} <# } else { #> {{{ data.actual_price }}} <# } #></b></bdi></span></span>
		</a>
        <div class="algolia-homepage-loop-product-buttons" onClick="sendEventToAlgolia('{{data.objectID}}','{{data.post_title}}','{{queryID}}','conversion')">
		<# if(data.stock_status == 0){ #>
			<a href="{{data.permalink}}" class="button product_type_simple" rel="nofollow">Out Of Stock</a>
			<# } else { #>
			<a href="?add-to-cart={{ data.post_id }}" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_{{ data.post_id }}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="{{ data.post_id }}" data-product_sku="{{ data.post_id }}" aria-label="Add to basket: “{{ data.post_title }}”" rel="nofollow">Add to basket</a>
			<# } #>
		</div>
        <?php
do_action( 'algolia_instantsearch_after_hit' );
        ?>
		</div>
    <div class="ais-clearfix"></div>
	</script>
	<script type="text/html" id="tmpl-fqb-products">    
    <div class="algolia-homepage-fqb-product fqb-carousel-item">
        <a href="{{ data.permalink }}" title="{{ data.post_title }}" class="ais-hits--title-link" itemprop="url">
        <# let queryID = localStorage.getItem("algoliaQueryID");
        if ( data.featured_image ) { #>
            <div class="ais-hits--thumbnail homepage-trending-thumbnail">
                <img src="{{ data.featured_image }}" height="90" class="fqb-product-image low-margin" alt="{{ data.post_title }}" title="{{ data.post_title }}" itemprop="image" />
		</div>
        <# } #>
            <h3 class="algolia-homepage-product-title single-line-text" itemprop="name headline">{{{ data._highlightResult.post_title.value }}}</h2>
            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span><# if(data.sale_price) { #> {{{ data.sale_price }}} <# } else { #> {{{ data.actual_price }}} <# } #></b></bdi></span></span>
		</a>
        <div class="algolia-homepage-loop-product-buttons" onClick="sendEventToAlgolia({{data.objectID}},'{{data.post_title}}','{{queryID}}','conversion')"><a href="?add-to-cart={{data.post_id}}" aria-describedby="woocommerce_loop_add_to_cart_link_describedby_{{data.post_id}}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart low-pd" data-product_id="{{data.post_id}}" data-product_sku="{{data.post_id}}" aria-label="Add to basket: “{{data.post_title}}”" rel="nofollow">Add to basket</a></div>
        <?php
do_action( 'algolia_instantsearch_after_hit' );
        ?>
		</div>
    <div class="ais-clearfix"></div>
	</script>
<script type="text/javascript">
    let inputElement = document.getElementById("elementor-search-form-3c414d4");
    inputElement = document.getElementById("elementor-search-form-90ece1e");
           
    document.addEventListener('DOMContentLoaded', function() {
		var ALGOLIA_INSIGHTS_SRC = "https://cdn.jsdelivr.net/npm/search-insights@2.17.2/dist/search-insights.min.js";

        !function(e,a,t,n,s,i,c){e.AlgoliaAnalyticsObject=s,e[s]=e[s]||function(){
        (e[s].queue=e[s].queue||[]).push(arguments)},e[s].version=(n.match(/@([^\/]+)\/?/) || [])[1],i=a.createElement(t),c=a.getElementsByTagName(t)[0],
        i.async=1,i.src=n,c.parentNode.insertBefore(i,c)
        }(window,document,"script",ALGOLIA_INSIGHTS_SRC,"aa");
            aa('init', {
            appId: 'LIGOXVVZ3B',
            apiKey: 'b561f263d560bce9550eae533fca970b',
			useCookie: true,
         });
		<?php
		if(is_front_page())
					{
					?>
					const { trendingItems } = instantsearch.widgets;
					
		/*var latestProducts = instantsearch({
						indexName: 'wp_post_products_latest',
						insights: true,
						searchClient: algoliasearch( algolia.application_id, algolia.search_api_key ),
					});
					latestProducts.addWidgets([
						instantsearch.widgets.configure({
							hitsPerPage: 16,
						}),
						instantsearch.widgets.hits({
							container: '#algolia-latest-products',
							transformItems(items) {
								return items.filter(item => item.stock_status != '0');
							},
							templates: {
								empty: '',
								item: wp.template('homepage-latest-products'),
							},
							
						}),
						
					]);
					
					//Home page New Arrival Sliders
					latestProducts.on('render', function(renderArgs) {
						jQuery('#algolia-latest-products ol.ais-Hits-list').slick({
							infinite: true,
							autoplay: true,
							autoplaySpeed: 3000,
							slidesToShow: 4,
							slidesToScroll: 1,
							responsive: [
								{
									breakpoint: 768,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										infinite: true,
										dots: true
									}
								},
							]
						});
					});
					latestProducts.start();
		*/
					const trendingProducts = instantsearch({
					  searchClient: algoliasearch( algolia.application_id, algolia.search_api_key ),
					  indexName: 'wp_posts_product',
						insights: true,
					}).addWidgets([
					  trendingItems({
						container: '#browse-trending-products',
							templates: {
								item: wp.template('homepage-trending-products'),
							},
					  }),
					]);
					// Homepage Best Seller Slider load
					trendingProducts.on('render', function() {						
						jQuery('#browse-trending-products .ais-TrendingItems  .ais-TrendingItems-container ol.ais-TrendingItems-list').slick({
							infinite: true,
							autoplay: true,
							autoplaySpeed: 3000,
							slidesToShow: 4,
							slidesToScroll: 1,        
							responsive: [
								{
									breakpoint: 768,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
										infinite: true,
										autoplay: false
									}
								},
							]
						});
					});
					trendingProducts.start();
					
					<?php
					}
					?>
        var input = document.getElementById('elementor-search-form-18f8535');
        input.setAttribute('autocomplete', 'off');
        var input = document.getElementById('elementor-search-form-703aef8');
        input.setAttribute('autocomplete', 'off');
        //startAlgoliaSearch();
        jQuery(document).on('input', '#elementor-search-form-18f8535, #elementor-search-form-703aef8', function() {
			let inputvalue1 = jQuery("#elementor-search-form-18f8535").val();
				let inputvalue2 = jQuery("#elementor-search-form-703aef8").val();
				if( (inputvalue1 && inputvalue1.length >= 1) || (inputvalue2 && inputvalue2.length >= 1)) {
					let searchKeyword = jQuery('#elementor-search-form-18f8535').val() ? jQuery('#elementor-search-form-18f8535').val() : jQuery('#elementor-search-form-703aef8').val();
					jQuery('#header-algolia-input').val(searchKeyword);
					startAlgoliaSearch();
					jQuery('#algolia-header-search-container').css('display', 'block');
					document.body.style.overflow = 'hidden'; 
				} 			
        });
        jQuery(document).on('input', '#header-algolia-input', function() {
            var searchKeywordInput = jQuery("#header-algolia-input").val();
			if(searchKeywordInput.length >= 1) {
				startAlgoliaSearch();
			}
        });
		const searchForm = document.querySelector('.elementor-search-form');
		const searchButton = searchForm.querySelector('button[type="submit"]');
		searchForm.addEventListener('submit', function(event) {
			let inputvalue1 = jQuery("#elementor-search-form-18f8535").val();
			let inputvalue2 = jQuery("#elementor-search-form-703aef8").val();
			event.preventDefault();
			if( (inputvalue1 && inputvalue1.length >= 1) || (inputvalue2 && inputvalue2.length >= 1)) {
				jQuery('#algolia-header-search-container').css('display', 'block');
				document.body.style.overflow = 'hidden';
				//startAlgoliaSearch();
			}
		});
        function startAlgoliaSearch()
        {
           
			if ( document.getElementById("algolia-header-search-container") ) {
				if ( algolia.indices.posts_product === undefined && document.getElementsByClassName("admin-bar").length > 0) {
					alert('It looks like you haven\'t indexed the searchable posts index. Please head to the Indexing page of the Algolia Search plugin and index it.');
				}
                //let searchQuery = jQuery('#elementor-search-form-3c414d4, #elementor-search-form-90ece1e').val();
				let searchQuery = jQuery('#header-algolia-input').val();
				const { carousel } = instantsearch.templates;
				const { frequentlyBoughtTogether } = instantsearch.widgets;
				/* Instantiate instantsearch.js */
				var search = instantsearch({
					indexName: algolia.indices.posts_product.name,
					insights: true,
					searchClient: algoliasearch( algolia.application_id, algolia.search_api_key ),
					routing: {
						router: instantsearch.routers.history({ writeDelay: 1000 }),
						stateMapping: {
							stateToRoute( indexUiState ) {
								return {
									s: indexUiState[ algolia.indices.posts_product.name ].query,
								//  page: indexUiState[ algolia.indices.posts_product.name ].page
								}
							},
							routeToState( routeState ) {
								const indexUiState = {};
								indexUiState[ algolia.indices.posts_product.name ] = {
									query: routeState.s,
									page: routeState.page
								};
								return indexUiState;
							}
						}
					}
				});
                search.addWidgets([
                    instantsearch.widgets.configure({
                            hitsPerPage: 30,
                            query : searchQuery,
							<?php if(!is_user_logged_in()){ ?> filters: 'restricted: "no"'<?php }?>
                    }),
					instantsearch.widgets.hits({
							container: '#header-algolia-hits',
							templates: {
								empty: 'No results were found for "<strong>{{query}}</strong>".',
								item: wp.template('header-instantsearch-hit')
							},
							transformData: {
								item: function (hit) {

									function replace_highlights_recursive (item) {
										if (item instanceof Object && item.hasOwnProperty('value')) {
											item.value = _.escape(item.value);
											item.value = item.value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
										} else {
											for (var key in item) {
												item[key] = replace_highlights_recursive(item[key]);
											}
										}
										return item;
									}

									hit._highlightResult = replace_highlights_recursive(hit._highlightResult);
									hit._snippetResult = replace_highlights_recursive(hit._snippetResult);

									return hit;
								}
							},
						}),
						/* Pagination widget */
						instantsearch.widgets.pagination({
							container: '#header-algolia-pagination',
							autoHide: true,
							showFirst: false,
						}),
//                     infiniteHits({
//                         container: document.querySelector('#header-algolia-hits'),
//                     }),
                    instantsearch.widgets.stats({
                    	container: '#algolia-stats',
                    	templates: {
                    	text(data, { html }) {
                    	let count = '';

                    	if (data.hasManyResults) {
                    		count += `${data.nbHits} results`;
                    	} else if (data.hasOneResult) {
                    		count += `1 result`;
                    	} else {
                    		count += `no result`;
                    	}

                    	return html`<span>${count} found</span>`;
                    	},
                    }
                }),
                instantsearch.widgets.clearRefinements({
                        container: '#clear-refinements',
                        templates : 
                            {
                                resetLabel({ hasRefinements }, { html }) {
                                    return html`<span>${hasRefinements ? 'Reset' : ''}</span>`;
                                },
                            }
                    }),
                    /* customMenu({
                        container: document.querySelector('#algolia-categories'),
						attribute: 'taxonomies.product_cat',
						sortBy: ['name:asc'],
						limit: 6,
					}), */
                    /* Brand refinement widget */
                    instantsearch.widgets.refinementList({
                        container: '#header-facet-brands',
                        attribute: 'taxonomies.pa_brand',
                        operator: 'and',
                        limit: 5,
                        showMore: true,							
                        collapsible: true,
                        searchable: true,
                        sortBy: ['isRefined:desc',' name:asc'],
                        collapsible: {
                            collapsed: true,
                        },
                    }),
                    /* Price refinement widget */
                    instantsearch.widgets.rangeSlider({
                        container: '#header-facet-pricing',
                        attribute: 'price',
                        pips: true
                    }),
					instantsearch.widgets.rangeSlider({
						container: '#header-facet-discount',
						attribute: 'discountAmount',
						pips: true
					}),
                    /* Category refinement widget */
                    instantsearch.widgets.refinementList({
                        container: '#header-facet-categories',
                        attribute: 'taxonomies.product_cat',
                        operator: 'and',
                        limit: 5,
                        showMore: true,							
                        collapsible: true,
                        searchable: true,
                        sortBy: ['isRefined:desc',' name:asc'],
                        collapsible: {
                            collapsed: true,
                        },
                    }),

                    /* Allergen refinement widget */
                    instantsearch.widgets.refinementList({
                        container: '#header-facet-allergen',
                        attribute: 'taxonomies.pa_allergen-information',
                        operator: 'and',
                        limit: 5,
                        showMore: true,	
                        showMoreLimit: 10,
                        collapsible: true,
                        searchable: true,
                        sortBy: ['isRefined:desc',' name:asc'],
                        collapsible: {
                            collapsed: true,
                        },
                    }),
                    //Sort by Widget					
                    instantsearch.widgets.sortBy({
                        container: '#header-sort-by-container',
                        items: [
                            { value: 'wp_posts_product', label: 'Sort by latest' },
                            { value: 'wp_post_products_price_asc', label: 'Sort by price: low to high' },
                            { value: 'wp_post_products_price_desc', label: 'Sort by price: high to low' }
                        ],
                        cssClasses: {
                            root: 'algolia-product-sort',
                            select: [
                                'algolia-product-sort-select',
                            ],
                        },
                    })
                                        
                ]);
                search.addWidgets([
//                     instantsearch.widgets.index({ indexName: 'wp_posts_product_query_suggestions' }).addWidgets([
//                         instantsearch.widgets.configure({
//                             hitsPerPage: 5,
//                             page: 1,
//                             query: '',
// 							filters: '',
// 							facetFilters:''
//                         }),
//                         instantsearch.widgets.hits({
//                             container: '#popular-search',
//                             templates: {
//                                 item: wp.template('header-instantsearch-popular-search')
//                             },
//                             transformData: {
//                                 item: function (hit) {
//                                     return hit;
//                                 }
//                             }
//                         }),
//                     ]),                    
                    instantsearch.widgets.index({ indexName: 'wp_posts_post' }).addWidgets([
                        instantsearch.widgets.configure({
                            hitsPerPage: 7,
                            query : searchQuery,
                            page: 0,
							filters: 'NOT taxonomies.post_tag:"Side Effects"',
                        }),
                        instantsearch.widgets.hits({
                            container: '#posts',
                            templates: {
                                item: wp.template('header-instantsearch-posts')
                            },
                            transformData: {
							item: function (hit) {
								return hit;
							}
						}
                        }),
                    ]),
                    instantsearch.widgets.lookingSimilar({
                        container: '#similar-products',
                        objectIDs: ['32491-0','142140-0'],
                        templates: { item: wp.template('header-instantsearch-hit') },
						transformItems(items) {
                            return items.filter(item => item.restricted !== 'yes');
                        },
                    }),
					
                ]);
                // Show recommended products
                search.on('render', function() {
					// Homepage Best Seller Slider load
					
				
					
					jQuery('#algolia-trending-items ol.ais-TrendingItems-list').slick({
						infinite: true,
						autoplay: true,
						autoplaySpeed: 3000,
						slidesToShow: 5,
						slidesToScroll: 1,
					});
                const hitsContainer = document.querySelector('.ais-Stats-text');
                const similarProductsContainer = document.querySelector('#rcmnd-products');
                const resultsDiv = document.getElementById('algolia-header-search');             
                if (hitsContainer && hitsContainer.innerHTML.includes('no result found')) {
                    
                    var heading = document.querySelector('.ais-LookingSimilar-title');
                    heading.textContent = 'Recommended products';
                    similarProductsContainer.style.display = 'flex';                    
                    resultsDiv.style.display = 'none';
                } else {
                    similarProductsContainer.style.display = 'none';
                    resultsDiv.style.display = 'flex';
                }
            });
			
                search.start();                            
            }
            

        }
        const sortByContainer = document.querySelector('.algolia-product-sort-select');
        if (sortByContainer && sortByContainer.options.length > 0 && sortByContainer.value === '') {
            sortByContainer.selectedIndex = 0;
        } else {
            console.error('Sort by container not found or has no options.');
        }
	});
    const { connectHits } = instantsearch.connectors;
    /* const { connectMenu } = instantsearch.connectors;
    const renderMenu  = (renderOptions, isFirstRender) => {
    const {
        items,
        refine,
        createURL,
        isShowingMore,
        canToggleShowMore,
        toggleShowMore,
        widgetParams,
    } = renderOptions;
    if (isFirstRender) {
        const ul = document.createElement('ul');
        const button = document.createElement('button');
        widgetParams.container.appendChild(ul);
    }

        widgetParams.container.innerHTML = items.map(
            item =>
                `<div class="category-item" data-value="${item.value}"><span>
                    ${item.label}
                </span></div>`
        ).join('');
        [...widgetParams.container.querySelectorAll('.category-item')].forEach(element => {
        element.addEventListener('click', event => {
        event.preventDefault();
        refine(event.currentTarget.dataset.value);
        });
    });
    };
    const customMenu = connectMenu(
        renderMenu
    ); */

    //Infinte scroll
    let lastRenderArgs;

        const infiniteHits = instantsearch.connectors.connectInfiniteHits(
        (renderArgs, isFirstRender) => {
            const { hits, showMore, widgetParams } = renderArgs;
            const { container } = widgetParams;

            lastRenderArgs = renderArgs;

            if (isFirstRender) {
            const sentinel = document.createElement('div');
            const infinteDiv = document.createElement('div');
            sentinel.classList.add('ais-Hits');   
            infinteDiv.classList.add('infinte-listing-checker');         
            container.appendChild(sentinel);
            sentinel.appendChild(document.createElement('ol'));    
            container.querySelector('ol').classList.add('ais-Hits-list');
            container.querySelector('ol').setAttribute('id', 'infinite-products');   
            container.appendChild(infinteDiv);
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                if (entry.isIntersecting && !lastRenderArgs.isLastPage) {
					//setTimeout(showMore, 1000);
                    showMore();
                }
                });
            });
            observer.observe(infinteDiv);

            return;
            }
            
            container.querySelector('ol').innerHTML = hits
            .map(
                hit => {
					let discountBadge = '';
					if(hit.taxonomies.product_tag == 'Buy 1, Get the Other Half Price'){
						discountBadge = '<div class="bf-discount-badge">'+ hit.taxonomies.product_tag +'</div>' ;
					}
					else if(hit.discountAmount)	{
						discountBadge = '<div class="bf-discount-badge">'+ hit.discountAmount +'% off</div>' ;
					}
					else {
						discountBadge = '';							
					}
					let addToCartButton = '';
						if(hit.stock_status == '0')
						{
							addToCartButton = `<div class="woocommerce-loop-product-buttons"><a href="#" class="button product_type_simple" aria-label="View Product: “${hit.post_title}”" rel="nofollow">Out Of Stock</a></div>`;
						}
						else
						{
							addToCartButton = `<div class="woocommerce-loop-product-buttons" onClick="sendEventToAlgolia('${hit.objectID}','${hit.post_title}','${hit.__queryID}','conversion')"><a href="?add-to-cart=${hit.post_id}"  aria-describedby="woocommerce_loop_add_to_cart_link_describedby_${hit.post_id}" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="${hit.post_id}" data-product_sku="${hit.post_id}" aria-label="Add to basket: “${hit.post_title}”" rel="nofollow">Add to basket</a></div>`;
						}
                return `<li class="ais-Hits-item">
                    <div class="algolia-header-single-product">
${discountBadge}
                        <a href="${ hit.permalink }" title="${ hit.post_title }" class="ais-hits--title-link" itemprop="url" onClick="sendEventToAlgolia('${hit.objectID}','${hit.post_title}','${hit.__queryID}','click')">
                            <div class="ais-hits--thumbnail">
                                <img src="${ hit.featured_image }" alt="${ hit.post_title }" title="${ hit.post_title }" itemprop="image" />
                            </div>
                            <h3 class="woocommerce-loop-product-title" itemprop="name headline">${ hit.post_title }</h2>
                            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><b><span class="woocommerce-Price-currencySymbol">£</span>${ hit.actual_price }</b></bdi></span></span>
                        </a>
                        ${addToCartButton}
                    </div>
                    <div class="ais-clearfix"></div>
                </li>`
				})
            .join('');
        }
        );

        // Custom Js Code        
        jQuery(document).on('click', '.header-search-close', function() {
            jQuery('#algolia-header-search-container').hide();
			
            //overlay.classList.remove('active');
        });
        jQuery(document).on('click', '.algolia-close-button', function() {
            jQuery('#algolia-header-search-container').hide();
            document.body.style.overflow = 'auto';
			//document.getElementById("elementor-search-form-703aef8").disabled = false;
            //overlay.classList.remove('active');
        });
        jQuery(document).on('click', '.guided-filters-skip-btn', function() {
            jQuery('.algolia-before-results').hide();
        });
		jQuery(document).on('input', '#header-algolia-input', function() {
            jQuery('.algolia-before-results').hide();
        });
        jQuery(document).on('click', '.algolia-popular-title', function() {
            var query = jQuery(this).data('query');
            jQuery('#header-algolia-input').val(query);
            jQuery('#header-algolia-input').trigger('input');
            //overlay.classList.add('active');
        });
        function updateViewAllUrls() {
            jQuery('.algolia-see-all').attr('href','/search/'+jQuery('#elementor-search-form-3c414d4, #elementor-search-form-90ece1e').val());
            
        }
        var observer = new MutationObserver(function(mutationsList, observer) {           
			updateViewAllUrls();
        });

        var targetNode = document.querySelector('#algolia-header-search');
        if (targetNode) {
            var config = { childList: true, subtree: true };
            observer.observe(targetNode, config);            
            updateViewAllUrls();
        }
        var overlay = document.getElementById('algolia-backdrop');
        document.getElementById('toggle-filters-button').addEventListener('click', function() {
            const filterOptions = document.getElementById('header-ais-facets');
            filterOptions.classList.toggle('open');
            overlay.classList.add('active');            
        });
        jQuery(document).on('click', '#close-button, .cancel-button, .view-items-button', function() {
            const filterOptions = document.getElementById('header-ais-facets');
            filterOptions.classList.remove('open');
            overlay.classList.remove('active');
        });
	// Send Conversion events data
	function sendEventToAlgolia(objectID,productName, queryId, eventType )
        {
            if(eventType == 'click')
            {            
                window.aa("clickedObjectIDsAfterSearch", {
                    eventName: "Product Clicked After Search",
                    index: "wp_posts_product",
                     queryID: queryId.toString(),
                    // queryID: queryId,
                    objectIDs: [objectID.toString()],
                    positions : [1],
                });
            }
            else
            {
            
                window.aa('convertedObjectIDs', {
                    eventName: "Product Added To Cart",
                    index: "wp_posts_product",
                    queryID: queryId.toString(),
                    objectIDs: [objectID.toString()],
                });
            }

        }
	function wishlistProduct(e, product_id){
            if(jQuery( 'body' ).hasClass( 'logged-in' )){
                <?php if(is_product()) {
				?>
					jQuery('.wishlist-icon').hide();
					jQuery('.view-wishlist').show();
				<?php
				} else {
				?>
					const targetIcon = e.target;	
					targetIcon.classList.toggle('far');
					targetIcon.classList.toggle('fas');	
				<?php } ?>	
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    type: 'POST',
                    data: {
                        action: 'wishlist_product',
                        product_id: product_id,      
                    },
                    success: function(response) {
                        if (response.data.action === 'added') {
                            //console.log('Product added to wishlist!');

                        } else if (response.data.action === 'removed') {
                            //console.log('Product removed from wishlist!');
                        }
                    },
                    error: function(xhr, status, error) {
                        //console.log('An error occurred: ' + error);
                    }
                });
            }
            else
            {
                alert('Please login to add the product in wishlist'); 
            }
        }

</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script>
			// 	homepage 2 col slider 
		jQuery('.slider-home-two-col .elementor-container ').slick({
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 2 , 
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
		// 		cat slider home 
		jQuery('.custom-slider-section').slick({
			infinite: true,
			slidesToShow: 4,
			autoplay: true,
			autoplaySpeed: 2000,
			infinite: true,
			slidesToScroll: 1 , 
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
		// 	homepage brand slider slider 
		jQuery('.brand-slider .elementor-container ').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1 ,
			autoplay: true,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
	</script>
	<script type="text/javascript"> (function(c,l,a,r,i,t,y){ c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)}; t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i; y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y); })(window, document, "clarity", "script", "p1527htagq"); </script>
</body>
</html>
