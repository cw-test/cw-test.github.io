<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SupaPress_Book {
	public static $sortByOptions = array(
		'relevance'        => 'Relevance',
		'publishdate-desc' => 'Newest to Oldest',
		'publishdate-asc'  => 'Oldest to Newest',
		'title-az'         => 'Title - A to Z',
		'title-za'         => 'Title - Z to A',
		'price-asc'        => 'Price - Low to High',
		'price-desc'       => 'Price - High to Low',
		'contributor-az'   => 'Author - A to Z',
		'contributor-za'   => 'Author - Z to A'
	);
	private $properties;
	private $params;
	private $result;
	private $book;

	public function __construct( $result, $properties, $params = array() ) {
		$this->properties = $properties;
		$this->params     = $params;
		$this->result     = $result;
	}

	public function get_atts() {
		return isset( $this->properties['atts'] ) ? $this->properties['atts'] : array();
	}

	public function has_filters() {
		return isset( $this->properties['show_filters'] ) && $this->properties['show_filters'] === 'on';
	}

	public function the_filters( $preloader = null, $limits = array(), $showText = 'Show more', $hideText = 'Show less', $clearText = 'Clear all filters' ) {
		$filters = '';

		if ( isset( $this->properties['show_filters'] ) && $this->properties['show_filters'] === 'on' ) {
			$filersConfig = isset( $this->properties['filters'] ) && ! empty( $this->properties['filters'] ) ? $this->properties['filters'] : array();
			$filters      .= '<div id="filter-wrapper-' . $this->properties['atts']['id'] . '"><span class="filter-load-wrapper preloader-on"
							data-show-text="' . $showText . '"
							data-hide-text="' . $hideText . '"
							data-clear-text="' . $clearText . '"
							data-filter-limits="' . htmlspecialchars( json_encode( $limits ), ENT_QUOTES ) . '"
							data-filters="' . htmlspecialchars( json_encode( $filersConfig ), ENT_QUOTES ) . '">';
			$filters      .= '   <img src="' . ( $preloader === null ? SUPAPRESS_PLUGIN_URL . '/admin/img/search-loading.gif' : $preloader ) . '" alt="Searching..." /></span>';
			$filters      .= '</div>';
		}

		echo $filters;
	}

	public function the_sort_by( $id = 'supapress-sort-by' ) {
		$sortBy = '';

		if ( isset( $this->properties['show_sort_by'] ) && $this->properties['show_sort_by'] === 'on' ) {
			if ( isset( $this->properties['sort_by'] ) && ! empty( $this->properties['sort_by'] ) ) {
				$sortBy .= '<span class="supapress-sort-by-wrapper"><select id="' . $id . '" class="supapress-sort-by">';

				foreach ( $this->properties['sort_by'] as $sort ) {
					$selected = isset( $this->params['order'] ) && $this->params['order'] === $sort ? ' selected="selected"' : '';
					$label    = apply_filters( 'supapress_sortby_label', self::$sortByOptions[ $sort ] );
					$sortBy   .= "<option{$selected} value='{$sort}'>{$label}</option>";
				}

				$sortBy .= '</select></span>';
			}
		}

		echo $sortBy;
	}

	public function the_per_page( $id = 'supapress-per-page' ) {
		$perPage = '';

		if ( isset( $this->properties['show_per_page'] ) && $this->properties['show_per_page'] === 'on' ) {
			$perPageOptions = $this->properties['per_page'];

			if ( ! $perPageOptions ) {
				return;
			}

			$perPageSelected = isset( $this->params['amount'] ) ? (int) $this->params['amount'] : '';
			$perPage         .= '<span class="supapress-per-page-wrapper"><select id="' . $id . '" class="supapress-per-page">';

			foreach ( $perPageOptions as $amount ) {
				$selected = $perPageSelected === (int) $amount ? ' selected="selected"' : '';
				$perPage  .= "<option{$selected} value='{$amount}'>{$amount}</option>";
			}
			$perPage .= '</select></span>';
		}

		echo $perPage;
	}

	public function the_pagination() {
		$pagination = '';

		if ( isset( $this->result->pagination ) && isset( $this->properties['show_pagination'] ) && $this->properties['show_pagination'] === 'on' ) {
			// If page is set use otherwise set to one
			$current = isset( $this->params['page'] ) ? (int) $this->params['page'] : 1;
			// Get total pages from service
			$total = $this->result->pagination->pages->total;

			// Range variables uses to work out how many number in the pagination e.g. range = 5 will product 3 4 5 6 7 where 5 is the current page.
			// Range MUST be a odd number so 1 is added is the number is even TODO make hard coded to 5 a configurable option of the pagination element
			$range     = 5;
			$range     = $range % 2 === 0 ? $range + 1 : $range;
			$rangeDiff = $range - 1;
			$rangeGap  = $rangeDiff / 2;

			// Work out the start and stop positions for the number based of the set range
			$start = $current - $rangeGap < 1 ? 1 : $current - $rangeGap;
			$stop  = $start + $rangeDiff > $total ? $total : $start + $rangeDiff;

			// If less numbers produced than the range diff and the totals allow update the start position to add more numbers
			if ( $stop - $start < $rangeDiff && $total > $range && $start >= $rangeGap ) {
				$start -= $rangeDiff - ( $stop - $start );
			} elseif ( $stop - $start < $rangeDiff && $total <= $range ) {
				$start = 1;
			}

			// start === stop, i.e. one page, then don't display anything and return if we have chosen to hide
			if ( $start === $stop && isset( $this->properties['hide_1_page_pagination'] ) && $this->properties['hide_1_page_pagination'] === 'on' ) {
				return;
			}

			// Open pagination wrapper
			$pagination .= "<span class='supapress-pagination-wrapper' data-total='{$total}' data-current='{$current}'>";

			// Previous button
			$pagination .= "<a href='javascript:void(0)' class='supapress-previous'>&lsaquo;</a>";

			// Loop number for paginator
			for ( $i = $start; $i <= $stop; $i ++ ) {
				if ( $i !== $current ) {
					$pagination .= "<a href='javascript:void(0)' class='supapress-page' data-page='{$i}'>{$i}</a>";
				} else {
					$pagination .= "<span class='supapress-current-page'>{$i}</span>";
				}
			}

			// Next button
			$pagination .= "<a href='javascript:void(0)' class='supapress-next'>&rsaquo;</a>";

			// Close pagination wrapper
			$pagination .= '</span>';
		}

		echo $pagination;
	}

	public function get_pagination() {
		return isset( $this->result->pagination ) ? $this->result->pagination : null;
	}

    public function get_params() {
        return isset( $this->params ) ? $this->params : null;
    }

	public function get_message() {
		return isset( $this->result->message ) ? $this->result->message : null;
	}

	public function the_result_count( $before = '<h2>', $after = '</h2>', $echo = true ) {
		$value = '';
		if ( $this->properties['show_result_count'] === 'on' && ! empty( $this->result->pagination ) ) {
			$pageStart = ( $this->result->pagination->results->amount * ( $this->result->pagination->pages->current - 1 ) ) + 1;

			if ( $this->result->pagination->pages->current === $this->result->pagination->pages->total ) {
				// if the last page is full
				$mod = $this->result->pagination->results->total % $this->result->pagination->results->amount;
				if ( $mod === 0 ) {
					$pageEnd = $pageStart + $this->result->pagination->results->amount - 1;
				} else {
					$pageEnd = $pageStart + ( $mod - 1 );
				}
			} else {
				$pageEnd = $pageStart + $this->result->pagination->results->amount - 1;
			}

			$value = $before . str_replace( array( '%pagestart%', '%pageend%', '%total%' ), array(
					$pageStart,
					$pageEnd,
					$this->result->pagination->results->total
				), $this->properties['result_count_text'] ) . $after;
		}

		if ( $echo ) {
			echo $value;
		}

		return $value;
	}

	public function the_search_term( $before = '<h2>', $after = '</h2>', $echo = true ) {
		$value = '';
		if ( $this->properties['show_search_term'] === 'on' && ! empty( $_GET['keyword'] ) ) {
			$keyword = stripslashes( $_GET['keyword'] );
			$value   = $before . esc_html( str_replace( '%term%', $keyword, $this->properties['search_term_text'] ) ) . $after;
		}

		if ( $echo ) {
			echo $value;
		}

		return $value;
	}

	public function has_books() {
		return !empty( $this->result->search );
	}

	public function has_book() {
		return isset( $this->result->book ) && count( $this->result->book ) === 1;
	}

	public function no_books() {
		echo (string) get_option( 'no_books' ) !== '' ? get_option( 'no_books' ) : SUPAPRESS_DEFAULT_NO_BOOKS_MESSAGE;
	}

	public function no_book() {
		echo (string) get_option( 'no_book' ) !== '' ? get_option( 'no_book' ) : SUPAPRESS_DEFAULT_BOOK_NOT_FOUND_MESSAGE;
	}

	public function count_books() {
		return $this->result->search !== null && count( $this->result->search ) > 0 ? count( $this->result->search ) : 0;
	}

	public function the_book( $isSearch = true ) {
		$this->book = $isSearch ? array_shift( $this->result->search ) : $this->result->book[0];
	}

	public function get_book() {
		return isset( $this->book ) ? $this->book : null;
	}

	public function set_book( $book ) {
		$this->book = $book;
	}

	public function get_seo_title() {
		return $this->_get( 'seo' );
	}

	public function _get( $property ) {
		return isset( $this->book ) && isset( $this->book->$property ) && ! empty( $this->book->$property ) ? $this->book->$property : null;
	}

	public function get_format_url_part() {
		if ( isset( $this->book ) && isset( $this->book->formats ) ) {
			foreach ( $this->book->formats as $format ) {
				if ( is_object( $format->isbn ) && $format->isbn->isbn === $this->get_isbn13() ) {
					return sanitize_title( $format->format->name );
				} elseif ( ! is_object( $format->isbn ) && $format->isbn === $this->get_isbn13() ) {
					return sanitize_title( $format->format->name );
				}
			}
		}

		return 'format';
	}

	public function get_isbn13() {
		return $this->_get( 'isbn13' );
	}

	public function get_author_url_part() {
		if ( isset( $this->book ) && !empty($this->book->contributors) ) {
			foreach ( $this->book->contributors as $contributor ) {
				if ( trim( $contributor->contributor->seo !== '' ) ) {
					return trim( $contributor->contributor->seo );
				}
			}
		}

		return 'author';
	}

	public function get_imprint_url_part() {
		if ( isset( $this->book ) && ! empty( $this->book->imprint ) ) {
			return sanitize_title( trim( $this->book->imprint->name ) );
		}

		return 'imprint';
	}

	public function get_publisher_url_part() {
		if ( isset( $this->book ) && ! empty( $this->book->publisher ) ) {
			return sanitize_title( trim( $this->book->publisher->name ) );
		}

		return 'publisher';
	}

	public function get_author_text() {
		if ( isset( $this->book ) && !empty($this->book->contributors) ) {
			foreach ( $this->book->contributors as $contributor ) {
				if ( trim( $contributor->contributor->name !== '' ) ) {
					return trim( $contributor->contributor->name );
				}
			}
		}

		return '';
	}

	public function the_publisher( $before = '<p class="sp__the-publisher">', $after = '</p>', $echo = true ) {
		$publisher = '';

		if ( isset( $this->properties['show_publisher'] ) && $this->properties['show_publisher'] === 'on' ) {
			$publisher = $this->get_publisher_text();
			$publisher = ! empty( $publisher ) ? "{$before}{$publisher}{$after}" : '';
		}

		if ( $echo ) {
			echo $publisher;
		} else {
			return $publisher;
		}

		return '';
	}

	public function get_publisher_text() {
		if ( isset( $this->book ) && ! empty( $this->book->publisher ) ) {
			return trim( $this->book->publisher->name );
		}

		return '';
	}

	public function the_imprint( $before = '<p class="sp__the-imprint"><strong>Genre:&nbsp;</strong>', $after = '</p>', $echo = true ) {
		$imprint = '';

		if ( isset( $this->properties['show_imprint'] ) && $this->properties['show_imprint'] === 'on' ) {
			$imprint = $this->get_imprint_text();
			$imprint = ! empty( $imprint ) ? "{$before}{$imprint}{$after}" : '';
		}

		if ( $echo ) {
			echo $imprint;
		} else {
			return $imprint;
		}

		return '';
	}

	public function get_imprint_text() {
		if ( isset( $this->book ) && ! empty( $this->book->imprint ) ) {
			return trim( $this->book->imprint->name );
		}

		return '';
	}

	public function the_cover( $before = '<p class="sp__the-cover">', $after = '</p>', $echo = true ) {
		$image = '';
		$cover = $this->get_cover();

		if ( isset( $this->properties['show_cover'] ) && $this->properties['show_cover'] === 'on' ) {
			if ( $cover !== null ) {
				$alt = htmlentities( $this->book->title );

				$lazyLoad = supapress_array_text( $this->properties, 'carousel_settings', 'lazy_load' ) === 'on';
				if ( $lazyLoad ) {
					$lazyPlaceholder = supapress_array_text( $this->properties, 'carousel_settings', 'lazy_load_placeholder' );
					if ( $lazyPlaceholder === '' ) {
						$lazyPlaceholder = supapress_default_lazyload_placeholder();
					}
					$src = 'src="' . $lazyPlaceholder . '" data-lazy';
				} else {
					$src = 'src';
				}

				$image = "<img class='main-image' data-baseline-images=\"image\" {$src}=\"{$cover}\" alt=\"{$alt}\" />";

				if ( isset( $this->properties['cover_link'] ) && $this->properties['cover_link'] !== '' ) {
					$url = supapress_get_template_url( $this->properties['cover_link'], $this );

					if ( $url !== false ) {
						$target = isset( $this->properties['cover_link_target'] ) && $this->properties['cover_link_target'] === 'on' ? 'target="_blank" ' : '';
						$image  = "<a {$target}href='" . $url . "'>{$image}</a>";
					}
				}

				$image = "{$before}{$image}{$after}";
			}
		}

		if ( $echo ) {
			echo $image;
		} else {
			return $image;
		}
	}

	public function get_cover() {
		// work out which cover filter to fire
		$filters            = array( 'supapress_cover_url' );
		$properties         = $this->get_properties();
		$type               = isset( $properties['widget_type'] ) ? $properties['widget_type'] : '';
		$layout             = isset( $properties['widget_layout'] ) ? $properties['widget_layout'] : '';
		$custom_layout_file = isset( $properties['custom_layout_file'] ) ? $properties['custom_layout_file'] : '';

		if ( $layout === 'custom' && $custom_layout_file !== 'default' ) {
			$fileName = str_replace( '-', '_', basename( $custom_layout_file ) );
			$fileName = str_replace( "{$type}_", '', $fileName );
			$fileName = preg_replace( '/\\.[^.\\s]{2,4}$/', '', $fileName );;
			$layout    .= "_{$fileName}";
			$filters[] = "supapress_cover_url_{$type}_custom";
		} elseif ( $type === 'product_details' && $custom_layout_file === 'default' ) {
			$layout = '';
		}

		$filters[] = $layout ? "supapress_cover_url_{$type}_{$layout}" : "supapress_cover_url_{$type}";
		$cover     = $this->_get( 'image' );

		foreach ( $filters as $filter ) {
			$cover = apply_filters( $filter, $cover );
		}

		return $cover;
	}

	public function get_properties() {
		return $this->properties;
	}

	public function cover_position() {
		$position = 'left';

		if ( isset( $this->properties['cover_right'] ) && $this->properties['cover_right'] === 'on' ) {
			$position = 'right';
		}

		echo $position;
	}

	public function the_title( $before = '	<header class="entry-header book-title"><h1 class="sp__the-title entry-title">', $after = '</h1></header>', $echo = true ) {
		$title     = '';
		$bookTitle = $this->get_title();

		if ( isset( $this->properties['show_title'] ) && $this->properties['show_title'] === 'on' ) {
			if ( $bookTitle !== null ) {
				$title = "{$bookTitle}";

				if ( isset( $this->properties['title_link'] ) && $this->properties['title_link'] !== '' ) {
					$url = supapress_get_template_url( $this->properties['title_link'], $this );

					if ( $url !== false ) {
						$target = isset( $this->properties['title_link_target'] ) && $this->properties['title_link_target'] === 'on' ? 'target="_blank" ' : '';
						$title  = "<a {$target}href='" . $url . "'>{$title}</a>";
					}
				}

				$title = "{$before}{$title}{$after}";
			}
		}

		if ( $echo ) {
			echo $title;
		} else {
			return $title;
		}
	}

	public function get_title() {
		return $this->_get( 'title' );
	}

	public function the_subtitle( $before = '<p class="sp__the-subtitle">', $after = '</p>', $echo = true ) {
		$subtitle     = '';
		$bookSubtitle = $this->get_subtitle();

		if ( isset( $this->properties['show_subtitle'] ) && $this->properties['show_subtitle'] === 'on' ) {
			if ( $bookSubtitle !== null ) {
				$subtitle = "{$before}{$bookSubtitle}{$after}";
			}
		}

		if ( $echo ) {
			echo $subtitle;
		} else {
			return $subtitle;
		}
	}

	public function get_subtitle() {
		return $this->_get( 'subtitle' );
	}

	public function the_price( $before = '<p class="sp__the-price">', $after = '</p>', $echo = true ) {
		$price      = '';
		$prices     = array();
		$bookPrices = $this->get_price();

		if ( isset( $this->properties['show_price'] ) && $this->properties['show_price'] === 'on' ) {
			if ( isset( $this->properties['price'] ) ) {
				if ( $bookPrices !== null ) {

					foreach ( $bookPrices as $p ) {
						$prices[ $p->locale ] = $p->amount;
					}

					foreach ( $this->properties['price'] as $p ) {
						if ( isset( $prices[ $p ] ) ) {
							if ( $p === 'USD' ) {
								$currency = '&#36;';
							} elseif ( $p === 'GBP' ) {
								$currency = '&#163;';
							} elseif ( $p === 'CAD' ) {
								$currency = 'CA&#36;';
							} elseif ( $p === 'AUD' ) {
								$currency = 'AU&#36;';
							} elseif ( $p === 'NZD' ) {
								$currency = 'NZ&#36;';
							} elseif ( $p === 'EUR' ) {
								$currency = '&#8364;';
							} else {
								$currency = '';
							}

							$price .= "{$before}{$currency}{$prices[$p]}{$after}";
						}
					}
				}
			}
		}

		if ( $echo ) {
			echo $price;
		} else {
			return $price;
		}
	}

	public function get_price() {
		return $this->_get( 'prices' );
	}

	public function the_format( $before = '<p class="sp__the-format"><strong>Format:&nbsp;</strong>', $after = '</p>', $echo = true ) {
		$format      = '';
		$bookFormats = $this->get_format();

		if ( isset( $this->properties['show_format'] ) && $this->properties['show_format'] === 'on' ) {
			if ( $bookFormats !== null ) {
				foreach ( $bookFormats as $f ) {
					$isbn = is_string( $f->isbn ) ? $f->isbn : $f->isbn->isbn;

					if ( $isbn === $this->get_isbn13() ) {
						$format = "{$before}{$f->format->name}{$after}";
						break;
					}
				}
			}
		}

		if ( $echo ) {
			echo $format;
		} else {
			return $format;
		}
	}

	public function get_format() {
		return $this->_get( 'formats' );
	}

	public function get_format_text() {
		$format = $this->get_format();
		if ( $format !== null ) {
			foreach ( $format as $f ) {
				$isbn = is_object( $f->isbn ) ? $f->isbn->isbn : $f->isbn;

				if ( $isbn === $this->get_isbn13() ) {
					return $f->format->name;
				}
			}
		}

		return '';
	}

	public function the_author( $before = '<p class="sp__the-author"><strong>Author:&nbsp;</strong>', $after = '</p>', $echo = true, $separator = ', ', $index = false ) {
		$authors      = array();
		$contributors = $this->get_author();

		if ( isset( $this->properties['show_author'] ) && $this->properties['show_author'] === 'on' && !empty($this->book->contributors) ) {
			if ( $contributors !== null ) {
				foreach ( $contributors as $i => $contributor ) {
					if ( is_int( $index ) && $index !== $i ) {
						continue;
					}
					if ( trim( $contributor->contributor->name !== '' ) ) {
						$authors[] = $contributor->contributor->name;
					}
				}

				$authors = $before . implode( $separator, $authors ) . $after;
			}
		}

		if ( empty( $authors ) ) {
			$authors = '';
		}

		if ( $echo ) {
			echo $authors;
		} else {
			return $authors;
		}
	}

	public function get_author() {
		return $this->_get( 'contributors' );
	}

	public function get_imprint() {
		return $this->_get( 'imprint' );
	}

	public function get_publisher() {
		return $this->_get( 'publisher' );
	}

	public function the_author_bio( $before = '<p class="sp__the-author-bio">', $after = '</p>', $echo = true, $separator = false, $index = false ) {
		$author_bios = array();
		if ( $separator === false ) {
			$separator = $after . $before;
		}
		$contributors = $this->get_author();

		if ( isset( $this->properties['show_author_bio'] ) && $this->properties['show_author_bio'] === 'on' && !empty($this->book->contributors) ) {
			if ( $contributors !== null ) {
				foreach ( $contributors as $i => $contributor ) {
					if ( is_int( $index ) && $index !== $i ) {
						continue;
					}
					if ( isset( $contributor->contributor->bio ) && trim( $contributor->contributor->bio !== '' ) ) {
						$author_bios[] = $contributor->contributor->bio;
					}
				}

				$author_bios = $before . implode( $separator, $author_bios ) . $after;
			}
		}

		if ( empty( $author_bios ) ) {
			$author_bios = '';
		}

		if ( $echo ) {
			echo $author_bios;
		} else {
			return $author_bios;
		}
	}

	public function the_publication_date( $before = '<p class="sp__the-publication-date"><strong>Published:&nbsp;</strong>', $after = '</p>', $echo = true ) {
		$date = '';
		/** @type stdClass $publicationDate */
		$publicationDate = $this->get_publication_date();

		if ( isset( $this->properties['show_pubdate'] ) && $this->properties['show_pubdate'] === 'on' ) {
			if ( $publicationDate !== null ) {
				$date = isset( $publicationDate->date ) ? $publicationDate->date : 0;

				if ( isset( $this->properties['pub_date_format'] ) && $this->properties['pub_date_format'] !== '' ) {
					$d    = new DateTime( $date, new DateTimeZone( $publicationDate->timezone ) );
					$date = $d->format( $this->properties['pub_date_format'] );
				}

				/** @type object $publicationDate */
				$date = "{$before}{$date}{$after}";
			}
		}

		if ( $echo ) {
			echo $date;
		} else {
			return $date;
		}
	}

	public function get_publication_date() {
		return $this->_get( 'date' );
	}

	public function the_sales_date( $before = '<p class="sp__the-sales-date">', $after = '</p>', $echo = true ) {
		$date = '';
		/** @var stdClass $salesDate */
		$salesDate = $this->get_sales_date();

		if ( isset( $this->properties['show_sales_date'] ) && $this->properties['show_sales_date'] === 'on' ) {
			if ( $salesDate !== null ) {
				$date = isset( $salesDate->date ) ? $salesDate->date : 0;

				if ( isset( $this->properties['sales_date_format'] ) && $this->properties['sales_date_format'] !== '' ) {
					$d    = new DateTime( $date, new DateTimeZone( $salesDate->timezone ) );
					$date = $d->format( $this->properties['pub_date_format'] );
				}

				/** @type object $salesDate */
				$date = "{$before}{$date}{$after}";
			}
		}

		if ( $echo ) {
			echo $date;
		} else {
			return $date;
		}
	}

	public function get_sales_date() {
		return $this->_get( 'sale_date' );
	}

	public function the_summary( $before = '<div class="sp__the-summary"><strong>Summary:&nbsp;</strong>', $after = '</div>', $echo = true ) {
		$summary     = '';
		$bookSummary = $this->get_summary();

		if ( isset( $this->properties['show_summary'] ) && $this->properties['show_summary'] === 'on' ) {
			if ( $bookSummary !== null ) {
				$summary = "{$before}{$bookSummary}{$after}";
			}
		}

		if ( $echo ) {
			echo $summary;
		} else {
			return $summary;
		}
	}

	public function get_summary() {
		return $this->_get( 'summary' );
	}

	public function the_description( $before = '<div class="sp__the-description">', $after = '</div>', $echo = true ) {
		$description     = '';
		$bookDescription = $this->get_description();

		if ( isset( $this->properties['show_description'] ) && $this->properties['show_description'] === 'on' ) {
			if ( $bookDescription !== null ) {
				$description = "{$before}{$bookDescription}{$after}";
			}
		}

		if ( $echo ) {
			echo $description;
		} else {
			return $description;
		}
	}

	public function get_description() {
		return $this->_get( 'description' );
	}

	public function get_seo_description() {
		$description = '';
		$book_description = $this->get_description();

		if( !empty($book_description) ) {
			$book_description = strip_tags($book_description);

			if( strlen( $book_description ) > 160 ) {
				$description = substr( $book_description, 0, 157 ) . '...';
			} else {
				$description = $book_description;
			}
		}

		return $description;
	}

	public function the_series( $before = '<p class="sp__the-series">', $after = '</p>', $echo = true ) {
		$series     = array();
		$separator  = ', ';
		$bookSeries = $this->get_series();

		if ( isset( $this->properties['show_series'] ) && $this->properties['show_series'] === 'on' && count( $this->book->series ) > 0 ) {
			if ( $bookSeries !== null ) {
				foreach ( $bookSeries as $s ) {
					if ( trim( $s->series->name !== '' ) ) {
						$series[] = $s->series->name;
					}
				}

				$series = $before . implode( $separator, $series ) . $after;
			}
		}

		if ( empty( $series ) ) {
			$series = '';
		}

		if ( $echo ) {
			echo $series;
		} else {
			return $series;
		}
	}

	public function get_series() {
		return $this->_get( 'series' );
	}

	public function the_isbn13( $before = '<p class="sp__the-isbn13"><strong>ISBN:&nbsp;</strong>', $after = '</p>', $echo = true ) {
		$isbn13     = '';
		$bookIsbn13 = $this->get_isbn13();

		if ( isset( $this->properties['show_isbn13'] ) && $this->properties['show_isbn13'] === 'on' ) {
			if ( $bookIsbn13 !== null ) {
				$isbn13 = "{$before}{$bookIsbn13}{$after}";
			}
		}

		if ( $echo ) {
			echo $isbn13;
		} else {
			return $isbn13;
		}
	}

	public function get_isbn10() {
		return $this->_get( 'isbn10' );
	}

	public function the_trim_size( $before = '<p class="sp__the-trim-size">', $after = '</p>', $echo = true ) {
		$trimsize  = '';
		$separator = ' x ';
		/** @type object $trim */
		$trim = $this->get_trim_size();

		if ( $trim !== null && isset( $this->properties['show_trimsize'] ) && $this->properties['show_trimsize'] === 'on' && !empty( $trim ) ) {
			if ( $trim->width !== null && $trim->height !== null && $trim->depth !== null && $trim->unit !== null ) {
				$trimsize .= $trim->width . $trim->unit . $separator;
				$trimsize .= $trim->height . $trim->unit . $separator;
				$trimsize .= $trim->depth . $trim->unit;
			} else {
				$trimsize = 'Trim size data not found for this book.';
			}

			$trimsize = "{$before}{$trimsize}{$after}";
		}

		if ( $echo ) {
			echo $trimsize;
		} else {
			return $trimsize;
		}
	}

	public function get_trim_size() {
		return $this->_get( 'trim' );
	}

	public function the_weight( $before = '<p class="sp__the-weight">', $after = '</p>', $echo = true ) {
		$weight = '';
		/** @type object $bookWeight */
		$bookWeight = $this->get_weight();

		if ( $bookWeight !== null && isset( $this->properties['show_weight'] ) && $this->properties['show_weight'] === 'on' && !empty( $bookWeight ) ) {
			if ( $bookWeight->weight !== null && $bookWeight->weight_unit !== null ) {
				$weight .= $bookWeight->weight . $bookWeight->weight_unit;
			} else {
				$weight = 'Weight data not found for this book.';
			}

			$weight = "{$before}{$weight}{$after}";
		}

		if ( $echo ) {
			echo $weight;
		} else {
			return $weight;
		}
	}

	public function get_weight() {
		return $this->_get( 'trim' );
	}

	public function the_awards( $before = '<p class="sp__the-awards">', $after = '</p>', $echo = true ) {
		$awards     = array();
		$separator  = '<br />';
		$bookAwards = $this->get_awards();

		if ( isset( $this->properties['show_awards'] ) && $this->properties['show_awards'] === 'on' ) {
			if ( $bookAwards !== null ) {
				foreach ( $bookAwards as $award ) {
					if ( trim( $award->award->name !== '' ) ) {
						$awards[] = $award->award->name;
					}
				}

				$awards = $before . implode( $separator, $awards ) . $after;
			}
		}

		if ( empty( $awards ) ) {
			$awards = '';
		}

		if ( $echo ) {
			echo $awards;
		} else {
			return $awards;
		}
	}

	public function get_awards() {
		return $this->_get( 'awards' );
	}

	public function the_reviews( $before = '<p class="sp__the-reviews">', $after = '</p>', $echo = true ) {
		$reviews     = array();
		$separator   = '<br /><br />';
		$bookReviews = $this->get_reviews();

		if ( isset( $this->properties['show_reviews'] ) && $this->properties['show_reviews'] === 'on' ) {
			if ( $bookReviews !== null ) {
				foreach ( $bookReviews as $review ) {
					if ( $review->review !== null && trim( $review->review->description ) !== '' ) {
						$reviews[] = $review->review->description;
					}
				}

				$reviews = $before . implode( $separator, $reviews ) . $after;
			}
		}

		if ( empty( $reviews ) ) {
			$reviews = '';
		}

		if ( $echo ) {
			echo $reviews;
		} else {
			return $reviews;
		}
	}

	public function get_reviews() {
		return $this->_get( 'reviews' );
	}

	public function the_pages( $before = '<p class="sp__the-pages"><strong>Pages:&nbsp;</strong>', $after = '</p>', $echo = true ) {
		$pages     = '';
		$bookPages = $this->get_pages();

		if ( isset( $this->properties['show_pages'] ) && $this->properties['show_pages'] === 'on' ) {
			if ( $bookPages !== null ) {
				$pages = $bookPages . ' Page';

				if ( $this->book->pages > 1 ) {
					$pages .= 's';
				}

				$pages = "{$before}{$pages}{$after}";
			}
		}

		if ( $echo ) {
			echo $pages;
		} else {
			return $pages;
		}
	}

	public function get_pages() {
		return $this->_get( 'pages' );
	}

	public function the_retailers( $before = '<p class="sp__the-retailers">', $after = '</p>', $echo = true ) {
		$retailers     = array();
		$separator     = '<br />';
		$bookRetailers = $this->get_retailers();

		if ( isset( $this->properties['show_retailers'] ) && $this->properties['show_retailers'] === 'on' ) {
			if ( $bookRetailers !== null ) {
				foreach ( $bookRetailers as $retailer ) {
					if ( trim( $retailer->label !== '' ) && trim( $retailer->path !== '' ) ) {
						$retailers[] = "<a href='{$retailer->path}' class='retailer-link {$retailer->seo}'>{$retailer->label}</a>";
					}
				}

				$retailers = $before . implode( $separator, $retailers ) . $after;
			}
		}

		if ( empty( $retailers ) ) {
			$retailers = '';
		}

		if ( $echo ) {
			echo $retailers;
		} else {
			return $retailers;
		}
	}

	public function get_retailers() {
		return $this->_get( 'retailers' );
	}

	/**
	 * Get the assets matching the params in $args
	 * $args = array('width' => '1000', 'type' => 'image', 'sub_type' => 'book-interior') - Query for type of assets
	 * wanted
	 * $prop = 'path' - name of the field you want returned
	 *
	 * If prop is passed then returned array will be a list of the selected values
	 *
	 * @param array $args
	 * @param string $prop
	 *
	 * @return array
	 */
	function get_assets( $args = array(), $prop = null ) {
		$assets = $this->_get( 'assets' );
		$return = array();

		if ( is_array( $assets ) ) {
			foreach ( $assets as $asset ) {
				$match = true;

				if ( ! empty( $args ) ) {
					foreach ( $args as $property => $value ) {
						if ( ! isset( $asset->asset->{$property} ) || $asset->asset->{$property} != $value ) {
							$match = false;
							break;
						}
					}
				}

				if ( $match ) {
					if ( $prop ) {
						if ( property_exists( $asset->asset, $prop ) ) {
							$return[] = $asset->asset->{$prop};
						}
					} else {
						$return[] = $asset;
					}
				}
			}
		}

		return $return;
	}
}
