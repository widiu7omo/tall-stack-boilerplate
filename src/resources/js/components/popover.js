export const popover = ({open, focus}) => ({
    open: open,
    focus: focus,
    init() {
    },
    onEscape: () => {
        this.focus = false
        this.open = false
    },
    onClosePopoverGroup() {
        this.focus = false
        this.open = false
    },
    toggle() {
        this.open = !this.open
    }
})
export const popoverGroup = () => ({
    init() {

    },
    onClosePopoverGroup() {
    },
})
