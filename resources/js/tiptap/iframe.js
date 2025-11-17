import { Node, mergeAttributes } from "@tiptap/core";

const Iframe = Node.create({
    name: "iframe",

    group: "block",

    atom: true,

    draggable: true,

    addAttributes() {
        return {
            src: {
                default: null,
                parseHTML: element => element.getAttribute('src'),
                renderHTML: attributes => {
                    if (!attributes.src) {
                        return {}
                    }
                    return {
                        src: attributes.src,
                    }
                },
            },
            width: {
                default: null,
                parseHTML: element => element.getAttribute('width'),
                renderHTML: attributes => {
                    if (!attributes.width) {
                        return {}
                    }
                    return {
                        width: attributes.width,
                    }
                },
            },
            height: {
                default: null,
                parseHTML: element => element.getAttribute('height'),
                renderHTML: attributes => {
                    if (!attributes.height) {
                        return {}
                    }
                    return {
                        height: attributes.height,
                    }
                },
            },
            title: {
                default: null,
                parseHTML: element => element.getAttribute('title'),
                renderHTML: attributes => {
                    if (!attributes.title) {
                        return {}
                    }
                    return {
                        title: attributes.title,
                    }
                },
            },
        }
    },

    parseHTML() {
        return [
            {
                tag: "iframe",
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return [
            "iframe",
            mergeAttributes(HTMLAttributes, {
                frameborder: "0",
                allowfullscreen: "true",
            })
        ];
    },

    addCommands() {
        return {
            insertIframe: options => ({ commands }) => {
                return commands.insertContent({
                    type: this.name,
                    attrs: options,
                })
            },
        }
    },
});

export default Iframe;
