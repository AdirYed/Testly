const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
    prefix: 'tw-',
    theme: {
        extend: {},
        colors: {
            primary: "var(--primary-color)",
            secondary: "var(--secondary-color)",
            white: "white",
            gray: colors.gray,
            red: colors.red,
            orange: colors.orange,
            yellow: colors.yellow,
            green: colors.green,
            teal: colors.teal,
            blue: colors.blue,
            indigo: colors.indigo,
            purple: colors.purple,
            pink: colors.pink,
            transparent: 'transparent',
        },
    },
    variants: {},
    plugins: []
}
