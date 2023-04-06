export const menu = (state) => ({
    open: state.open,
    activeIndex: 0,
    init() {

    },
    onClickAway(e) {
        this.open = false;
    }, focusButton() {

    },
    activeDescendant() {

    },
    onArrowUp() {

    },
    onArrowDown() {

    },
    onMouseEnter(e) {
    },
    onMouseMove(e, index) {
        this.activeIndex = index;
    },
    onMouseLeave(e) {
        this.activeIndex = -1;
    },
    onButtonClick() {
        this.open = !this.open
    }
})
