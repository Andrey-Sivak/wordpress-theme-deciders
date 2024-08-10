import PostScroller from './PostScroller.js';

class CaseFilter {
	isMobile = !window.matchMedia('(min-width: 767px)').matches;

	constructor() {
		this.page = 1;
		this.loading = false;
		this.casesList = document.getElementById('cases-list');
		this.loadMore = document.getElementById('load-more');
		this.serviceGrid = document.getElementById('service-grid');
		this.serviceItems = this.serviceGrid.querySelectorAll('.service-item');
		this.serviceMobileFilter = document.querySelector('.ds-mobile-filters');
		this.serviceMobileFilterButton = this.serviceMobileFilter.querySelector(
			'.ds-mobile-filters__button',
		);
		this.serviceMobileFilterItems = [
			...this.serviceMobileFilter.querySelectorAll('.service-item-mob'),
		];
		this.mobileOverlay = document.querySelector(
			'.ds-mobile-filters__overlay',
		);
		this.currentServiceId = 'all';
		this.postScroller = null;

		if (!this.isMobile) {
			this.initMasonry();
		} else {
			this.postScroller = new PostScroller();
		}

		this.initEventListeners();
		this.updateGrid('all');
	}

	initMasonry() {
		this.masonry = new Masonry(this.casesList, {
			itemSelector: '.masonry-item',
			columnWidth: '.grid-sizer',
			percentPosition: true,
			gutter: 22,
		});

		imagesLoaded(this.casesList).on('progress', () => {
			this.masonry.layout();
		});
	}

	displayMobileFilter(e) {
		if (e) {
			e.preventDefault();
		}

		if (!this.isMobile) return;

		if (this.serviceMobileFilter.classList.contains('active')) {
			this.serviceMobileFilter.classList.remove('active');
			return;
		}

		this.serviceMobileFilter.classList.add('active');
	}

	selectMobileFilter(e) {
		e.preventDefault();

		const target = e.currentTarget;
		const serviceId = target.dataset.serviceId;

		const activeItemText = this.serviceMobileFilterButton.querySelector(
			'.ds-mobile-filters__button_text',
		).innerHTML;
		const targetText = target.querySelector(
			'.service-item-mob__text',
		).innerHTML;

		if (activeItemText === targetText) {
			this.displayMobileFilter();
			return;
		}

		const oldItem = this.serviceMobileFilterItems.find((item) =>
			item.classList.contains('hidden'),
		);

		this.serviceMobileFilterButton.querySelector(
			'.ds-mobile-filters__button_icon',
		).innerHTML = target.querySelector('.service-item-mob__icon').innerHTML;

		this.serviceMobileFilterButton.querySelector(
			'.ds-mobile-filters__button_text',
		).innerHTML = target.querySelector('.service-item-mob__text').innerHTML;

		target.classList.remove('flex');
		target.classList.add('hidden');

		oldItem.classList.remove('hidden');
		oldItem.classList.add('flex');

		this.displayMobileFilter();

		this.currentServiceId = serviceId;
		this.updateGrid(this.currentServiceId);
		this.page = 1;
		this.loadCases();
	}

	mobileFilter(e) {
		e.preventDefault();
	}

	initEventListeners() {
		this.serviceItems.forEach((item) => {
			item.addEventListener(
				'click',
				this.handleServiceItemClick.bind(this),
			);
		});

		if (this.isMobile) {
			this.serviceMobileFilterButton.addEventListener(
				'click',
				this.displayMobileFilter.bind(this),
			);

			this.serviceMobileFilterItems.forEach((item) =>
				item.addEventListener(
					'click',
					this.selectMobileFilter.bind(this),
				),
			);

			this.mobileOverlay.addEventListener(
				'click',
				this.displayMobileFilter.bind(this),
			);
		}

		// document.getElementById('load-more-btn').addEventListener('click', this.handleLoadMore.bind(this));

		// window.addEventListener('scroll', this.handleScroll.bind(this));
	}

	handleServiceItemClick(event) {
		const serviceId = event.currentTarget.dataset.serviceId;

		if (serviceId === this.currentServiceId) return;

		this.currentServiceId = serviceId;
		this.updateGrid(this.currentServiceId);
		this.page = 1;
		this.loadCases();
	}

	handleLoadMore() {
		this.page++;
		this.loadCases(true);
	}

	handleScroll() {
		if (
			window.innerHeight + window.scrollY >=
			document.body.offsetHeight - 100
		) {
			// if (this.loadMore.style.display !== 'none') {
			//     this.handleLoadMore();
			// }
		}
	}

	updateGrid(selectedServiceId) {
		this.serviceItems.forEach((item) => {
			item.classList.remove('selected');
			item.querySelector('.service-filter-btn').classList.remove(
				'active',
			);
		});

		const selectedItem = Array.from(this.serviceItems).find(
			(item) => item.dataset.serviceId === selectedServiceId,
		);
		selectedItem.classList.add('selected');
		selectedItem
			.querySelector('.service-filter-btn')
			.classList.add('active');

		// Force a reflow to trigger the transition
		this.serviceGrid.offsetHeight;

		// Adjust the grid to move the selected item to the start
		this.serviceGrid.style.gridTemplateAreas =
			'"selected selected" "." "."';
		selectedItem.style.gridArea = 'selected';
	}

	loadCases(append = false) {
		if (this.loading) return;
		this.loading = true;

		const data = new FormData();
		data.append('action', 'ds_filter_cases_handler');
		data.append('service_id', this.currentServiceId);
		data.append('page', this.page);

		fetch(options.ajax_url, {
			method: 'POST',
			credentials: 'same-origin',
			body: data,
		})
			.then((response) => response.json())
			.then((data) => {
				this.handleCasesResponse(data, append);
			})
			.catch((error) => {
				console.error('Error:', error);
				this.loading = false;
			});
	}

	handleCasesResponse(response, append) {
		if (!this.isMobile) {
			if (append) {
				const tempDiv = document.createElement('div');
				tempDiv.innerHTML = response.cases;
				const newItems = tempDiv.children;
				this.casesList.append(...newItems);
				this.masonry.appended(newItems);
			} else {
				if (response?.cases) {
					this.casesList.innerHTML =
						'<div class="grid-sizer"></div>' + response.cases;
					this.masonry.reloadItems();
				} else {
					this.casesList.innerHTML =
						'В выбранной категории еще нет доступных кейсов';
					this.loading = false;
					return;
				}
			}

			// this.loadMore.style.display = response.has_more ? 'block' : 'none';

			imagesLoaded(this.casesList).on('progress', () => {
				this.masonry.layout();
			});
		} else {
			this.postScroller.toTop();
			this.postScroller.destroy();
			this.casesList.innerHTML = response.cases;
			this.postScroller = new PostScroller();
		}

		this.loading = false;
	}
}

document.addEventListener('DOMContentLoaded', () => {
	new CaseFilter();
});
