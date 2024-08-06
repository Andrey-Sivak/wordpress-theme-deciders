class PostScroller {
	posts = document.querySelectorAll('.ds-post');
	panelsCount = this.posts.length;
	scrollDirection = '';
	isScrolling = false;
	layoutGrid = document.querySelector('.layout-grid');
	lastInfoBlock = null;
	firstPost = document.querySelector('.ds-post');
	isFullscreenMode = false;

	constructor() {
		this.settings = {
			scrollStep: 100,
			swipeThreshold: 100,
			swipeSlack: 50,
			allowedTouchTime: 500,
			scrollAnimationDuration: 1000,
			smoothScrollDuration: 700,
		};

		this.init();
	}

	init() {
		this.defineLastInfoBlock();
		this.layoutGrid.style.transform = 'translateY(0)';
		this.addEventListeners();
	}

	defineLastInfoBlock() {
		if (document.body.classList.contains('archive')) {
			this.lastInfoBlock = document.querySelector(
				'.service-filter-container',
			);

			return;
		}

		this.lastInfoBlock = [
			...document.querySelectorAll('.info-block:not(.md\\:block)'),
		].at(-1);
	}

	addEventListeners() {
		this.layoutGrid.addEventListener('wheel', this.handleWheel.bind(this));
		this.addSwipeListeners(this.layoutGrid);
		window.addEventListener('scroll', this.handleScroll.bind(this));
		window.addEventListener('resize', this.handleScroll.bind(this));
		this.posts.forEach((post) =>
			post.addEventListener('click', this.handlePostClick.bind(this)),
		);
	}

	handleWheel(event) {
		if (this.isFullscreenMode) {
			event.preventDefault();
			this.scrollDirection = event.deltaY < 0 ? 'down' : 'up';
			this.scrollY(this.layoutGrid);
		}
	}

	handleScroll() {
		const lastInfoBlockRect = this.lastInfoBlock.getBoundingClientRect();

		if (
			this.isElementInViewport(this.firstPost) &&
			lastInfoBlockRect.bottom <= 0 &&
			!this.isFullscreenMode
		) {
			this.enableFullscreenMode();
		} else if (lastInfoBlockRect.bottom > 0 && this.isFullscreenMode) {
			this.disableFullscreenMode();
		}
	}

	handlePostClick() {
		this.scrollDirection = 'top';
		this.scrollY(this.layoutGrid);
	}

	scrollY(panel) {
		const vh = window.innerHeight / 100;
		// const vmin = Math.min(window.innerHeight, window.innerWidth) / 100;
		const panelLength = parseInt(panel.offsetHeight / vh);
		let scrollLength = parseInt(
			panel.style.transform.replace('translateY(', ''),
		);

		if (
			this.scrollDirection === 'up' &&
			Math.abs(scrollLength) <
				panelLength - panelLength / this.panelsCount
		) {
			scrollLength -= this.settings.scrollStep;
		} else if (this.scrollDirection === 'down' && scrollLength < 0) {
			scrollLength += this.settings.scrollStep;
		} else if (this.scrollDirection === 'down' && scrollLength === 0) {
			scrollLength = 0;
			this.disableFullscreenMode();
		} else if (this.scrollDirection === 'top') {
			scrollLength = 0;
		}

		if (!this.isScrolling) {
			this.isScrolling = true;
			panel.style.transform = `translateY(${scrollLength}dvh)`;
			setTimeout(() => {
				this.isScrolling = false;
			}, this.settings.scrollAnimationDuration);
		}
	}

	addSwipeListeners(element) {
		let startX, startY, startTime;

		element.addEventListener('touchstart', (e) => {
			const touch = e.changedTouches[0];
			startX = touch.pageX;
			startY = touch.pageY;
			startTime = new Date().getTime();
		});

		element.addEventListener('touchmove', (e) => {
			if (this.isFullscreenMode) {
				e.preventDefault();
			}
		});

		element.addEventListener('touchend', (e) => {
			const touch = e.changedTouches[0];
			const deltaX = touch.pageX - startX;
			const deltaY = touch.pageY - startY;
			const elapsedTime = new Date().getTime() - startTime;

			if (elapsedTime <= this.settings.allowedTouchTime) {
				if (
					Math.abs(deltaX) >= this.settings.swipeThreshold &&
					Math.abs(deltaY) <= this.settings.swipeSlack
				) {
					// Horizontal swipe - not handled in this code
				} else if (
					Math.abs(deltaY) >= this.settings.swipeThreshold &&
					Math.abs(deltaX) <= this.settings.swipeSlack
				) {
					this.scrollDirection = deltaY < 0 ? 'up' : 'down';
					if (
						this.scrollDirection === 'up' ||
						(this.scrollDirection === 'down' &&
							element.style.transform !== 'translateY(0)')
					) {
						this.scrollY(element);
					}
				}
			}
			e.stopPropagation();
		});
	}

	isElementInViewport(element) {
		const rect = element.getBoundingClientRect();
		return (
			rect.top <
				(window.innerHeight || document.documentElement.clientHeight) &&
			rect.bottom > 0 &&
			rect.left <
				(window.innerWidth || document.documentElement.clientWidth) &&
			rect.right > 0
		);
	}

	enableFullscreenMode() {
		this.lastInfoBlock.style.marginBottom = '110vh';
		this.isFullscreenMode = true;
		this.layoutGrid.style.position = 'fixed';
		this.layoutGrid.style.top = '0';
		this.layoutGrid.style.left = '0';
		this.layoutGrid.style.width = '100%';
		this.layoutGrid.style.overflow = 'hidden';
		this.layoutGrid.style.background = '#191919';
		this.layoutGrid.style.zIndex = 100000;
		document.body.style.overflow = 'hidden';
	}

	disableFullscreenMode() {
		this.lastInfoBlock.style.marginBottom = '0';
		this.isFullscreenMode = false;
		this.layoutGrid.style.position = '';
		this.layoutGrid.style.top = '';
		this.layoutGrid.style.left = '';
		this.layoutGrid.style.width = '';
		this.layoutGrid.style.overflow = '';
		document.body.style.overflow = '';
		this.layoutGrid.style.background = 'transparent';
		this.layoutGrid.style.zIndex = 'unset';
		this.layoutGrid.style.transform = 'translateY(0)';

		this.smoothScrollTo(this.settings.smoothScrollDuration);
	}

	smoothScrollTo(duration) {
		const targetY =
			this.lastInfoBlock.getBoundingClientRect().top + window.scrollY;
		const startY = window.scrollY || document.documentElement.scrollTop;
		const difference = targetY - startY;
		const startTime = performance.now();

		const step = () => {
			const progress = (performance.now() - startTime) / duration;
			if (progress < 1) {
				window.scrollTo(
					0,
					startY + difference * this.easeInOutCubic(progress),
				);
				requestAnimationFrame(step);
			} else {
				window.scrollTo(0, targetY);
			}
		};

		requestAnimationFrame(step);
	}

	easeInOutCubic(t) {
		return t < 0.5
			? 4 * t * t * t
			: (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
	}
}

export default PostScroller;
