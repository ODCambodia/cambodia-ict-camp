<?php

/**
 * Template Name: Camp Programme
 */

get_header();

$sheet_url = get_post_field('camp_programme_google_sheet');
$file = file_get_contents($sheet_url);

global $event_star_customizer_all_values;
$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];
?>

<!-- CSS to properly display Google Sheets -->
<style>
    #table-container {
        max-width: 100%;
        margin: 0 auto;
    }

    .table-responsive {
        margin-top: 20px;
    }

    #top-bar,
    #table-container table .header-shim,
    #table-container table thead .row-header-shim,
    #table-container .row-headers-background,
    #table-container .freezebar-cell,
    #table-container #footer {
        display: none;
    }

    #table-container td[colspan="5"],
    #table-container .s0,
    #table-container .s1 {
        font-family: 'DM Serif Display', serif;
        font-weight: 500;
        border: 1px solid;
        font-size: 1.7rem;
    }

    #table-tabs {
        border-top: 0;
        justify-content: center;
        visibility: hidden;
    }

    #table-container td {
        font-family: 'DM Sans', sans-serif;
        padding: .5em;
        border: 1px solid;
    }

    #sheets-viewport {
        width: auto !important;
        height: auto !important;
    }

    .grid-container {
        padding: 0;
    }
</style>

<!-- Section: Title and Breadcrumbs -->
<?php if ( (is_front_page() && 1 != $event_star_hide_front_page_header) || !is_front_page() ) { ?>

    <div class="wrapper inner-main-title">
        <div id="particles-js"></div>
        
        <div class="container">
            <header class="entry-header init-animate">
                <?php
                the_title('<h1 class="entry-title">', '</h1>');

                if (1 == $event_star_customizer_all_values['event-star-show-breadcrumb']) {
                    event_star_breadcrumbs();
                }
                ?>
            </header>
        </div>
    </div>

<?php } ?>

<!-- Section: Content and Tables -->
<div class="site-content container">
    <div class="content-area" id="primary">
        <main id="main" class="site-main">
            <?php the_content(); ?>
        </main>
    </div>

    <ul class="nav nav-tabs" id="table-tabs" role="tabList">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" type="button" role="tab" aria-selected="true">
                Agenda Day 1
            </button>
        </li>
    </ul>

    <div id="table-container" class="table-responsive">
        <?php echo $file; ?>
    </div>
</div>

<script>
    function toggleActiveNavBtn(e) {
        document.querySelectorAll('#myTab li.nav-item').forEach(function (el) {
            el.firstChild.classList.remove('active');
        })

        e.currentTarget.classList.add('active');
    }
    
    document.addEventListener("DOMContentLoaded", function (event) {
        const main = document.getElementById("table-container");
        const styles = document.querySelectorAll("#table-container style");
        const table = document.querySelector('#table-container #sheets-viewport');
        const sheetNavBtns = document.querySelectorAll('#top-bar #sheet-menu li');
        const customNav = document.querySelector('#myTab li.nav-item');

        customNav.firstChild.addEventListener('click', function (e) {
            toggleActiveNavBtn(e);
            sheetNavBtns[0].click();
        });

        customNav.firstChild.addEventListener('touchstart', function (e) {
            toggleActiveNavBtn(e);
            sheetNavBtns[0].click();
        });

        for (let i = 1; i < sheetNavBtns.length; i++) {
            const tempNav = customNav.cloneNode(true);
            const btn = tempNav.querySelector('button');
            
            btn.classList.remove('active');
            btn.innerText = TRANSLATE.agenda_day + ' ' + (i + 1);
            
            btn.addEventListener('click', function (e) {
                toggleActiveNavBtn(e);
                sheetNavBtns[i].click();
            });
            
            btn.addEventListener('touchstart', function (e) {
                toggleActiveNavBtn(e);
                sheetNavBtns[i].click();
            });

            document.getElementById('myTab').append(tempNav);
        }

        main.innerHTML = '';

        console.log(styles);
        
        styles.forEach((s) => main.append(s));
        
        main.append(table);
        
        table.style.width = 'auto';
        table.style.height = 'auto';
    });
</script>

<?php
get_footer();