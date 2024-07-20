class CaseFilter {
    constructor() {
        this.page = 1;
        this.loading = false;
        this.casesList = document.getElementById('cases-list');
        this.loadMore = document.getElementById('load-more');
        this.serviceGrid = document.getElementById('service-grid');
        this.serviceItems = this.serviceGrid.querySelectorAll('.service-item');
        this.currentServiceId = 'all';

        this.initMasonry();
        this.initEventListeners();
        this.updateGrid('all');
    }

    initMasonry() {
        this.masonry = new Masonry(this.casesList, {
            itemSelector: '.masonry-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
            gutter: 22
        });

        imagesLoaded(this.casesList).on('progress', () => {
            this.masonry.layout();
        });
    }

    initEventListeners() {
        this.serviceItems.forEach(item => {
            item.addEventListener('click', this.handleServiceItemClick.bind(this));
        });

        // document.getElementById('load-more-btn').addEventListener('click', this.handleLoadMore.bind(this));

        window.addEventListener('scroll', this.handleScroll.bind(this));
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
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
            // if (this.loadMore.style.display !== 'none') {
            //     this.handleLoadMore();
            // }
        }
    }

    updateGrid(selectedServiceId) {
        this.serviceItems.forEach(item => {
            item.classList.remove('selected');
            item.querySelector('.service-filter-btn').classList.remove('active');
        });

        const selectedItem = Array.from(this.serviceItems).find(item => item.dataset.serviceId === selectedServiceId);
        selectedItem.classList.add('selected');
        selectedItem.querySelector('.service-filter-btn').classList.add('active');

        // Force a reflow to trigger the transition
        this.serviceGrid.offsetHeight;

        // Adjust the grid to move the selected item to the start
        this.serviceGrid.style.gridTemplateAreas = '"selected selected" "." "."';
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
            body: data
        })
            .then(response => response.json())
            .then(data => {
                this.handleCasesResponse(data, append)
            })
            .catch(error => {
                console.error('Error:', error);
                this.loading = false;
            });
    }

    handleCasesResponse(response, append) {
        const casesHtml = response.cases.map(caseItem => `
            <a href="${caseItem.permalink}" class="masonry-item group text-white">
                <img src="${caseItem.thumbnail_url}" class="relative z-20" alt="${caseItem.title}">
            </a>
        `).join('');

        if (append) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = casesHtml;
            const newItems = tempDiv.children;
            this.casesList.append(...newItems);
            this.masonry.appended(newItems);
        } else {
            if (Array.isArray(response.cases) && response.cases.length) {
                this.casesList.innerHTML = '<div class="grid-sizer"></div>' + casesHtml;
                this.masonry.reloadItems();
            } else {
                this.casesList.innerHTML = 'В выбранной категории еще нет доступных кейсов';
                this.loading = false;
                return;
            }
        }

        // this.loadMore.style.display = response.has_more ? 'block' : 'none';
        this.loading = false;

        imagesLoaded(this.casesList).on('progress', () => {
            this.masonry.layout();
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new CaseFilter();
});