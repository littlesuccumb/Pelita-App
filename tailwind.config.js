import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Primary colors untuk sistem manajemen aset
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                // Secondary colors
                secondary: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
                // Status colors
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '128': '32rem',
            },
            maxWidth: {
                '8xl': '88rem',
                '9xl': '96rem',
            },
            minHeight: {
                '16': '4rem',
                '20': '5rem',
                '24': '6rem',
            },
            borderRadius: {
                '4xl': '2rem',
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                'hard': '0 10px 40px -10px rgba(0, 0, 0, 0.2)',
            },
            animation: {
                'slide-in': 'slideIn 0.3s ease-out',
                'slide-out': 'slideOut 0.3s ease-in',
                'fade-in': 'fadeIn 0.3s ease-out',
                'scale-in': 'scaleIn 0.2s ease-out',
            },
            keyframes: {
                slideIn: {
                    '0%': { transform: 'translateX(-100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                slideOut: {
                    '0%': { transform: 'translateX(0)', opacity: '1' },
                    '100%': { transform: 'translateX(-100%)', opacity: '0' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                scaleIn: {
                    '0%': { transform: 'scale(0.9)', opacity: '0' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
            },
        },
    },

    plugins: [
        forms,
        // Plugin untuk custom utilities
        function({ addUtilities, addComponents, theme }) {
            // Custom components
            addComponents({
                // Button components
                '.btn': {
                    padding: `${theme('spacing.2')} ${theme('spacing.4')}`,
                    borderRadius: theme('borderRadius.lg'),
                    fontWeight: theme('fontWeight.medium'),
                    fontSize: theme('fontSize.sm'),
                    lineHeight: theme('lineHeight.5'),
                    transition: 'all 0.15s ease-in-out',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    textDecoration: 'none',
                    cursor: 'pointer',
                    border: '1px solid transparent',
                    '&:focus': {
                        outline: '2px solid transparent',
                        outlineOffset: '2px',
                        boxShadow: `0 0 0 3px ${theme('colors.primary.200')}`,
                    },
                    '&:disabled': {
                        opacity: '0.5',
                        cursor: 'not-allowed',
                    },
                },
                '.btn-primary': {
                    backgroundColor: theme('colors.primary.600'),
                    color: theme('colors.white'),
                    '&:hover': {
                        backgroundColor: theme('colors.primary.700'),
                    },
                    '&:active': {
                        backgroundColor: theme('colors.primary.800'),
                    },
                },
                '.btn-secondary': {
                    backgroundColor: theme('colors.secondary.100'),
                    color: theme('colors.secondary.700'),
                    '&:hover': {
                        backgroundColor: theme('colors.secondary.200'),
                    },
                },
                '.btn-success': {
                    backgroundColor: theme('colors.success.600'),
                    color: theme('colors.white'),
                    '&:hover': {
                        backgroundColor: theme('colors.success.700'),
                    },
                },
                '.btn-warning': {
                    backgroundColor: theme('colors.warning.500'),
                    color: theme('colors.white'),
                    '&:hover': {
                        backgroundColor: theme('colors.warning.600'),
                    },
                },
                '.btn-danger': {
                    backgroundColor: theme('colors.danger.600'),
                    color: theme('colors.white'),
                    '&:hover': {
                        backgroundColor: theme('colors.danger.700'),
                    },
                },
                '.btn-outline': {
                    backgroundColor: 'transparent',
                    borderColor: theme('colors.secondary.300'),
                    color: theme('colors.secondary.700'),
                    '&:hover': {
                        backgroundColor: theme('colors.secondary.50'),
                        borderColor: theme('colors.secondary.400'),
                    },
                },

                // Card components
                '.card': {
                    backgroundColor: theme('colors.white'),
                    borderRadius: theme('borderRadius.lg'),
                    boxShadow: theme('boxShadow.soft'),
                    padding: theme('spacing.6'),
                },
                '.card-header': {
                    borderBottom: `1px solid ${theme('colors.secondary.200')}`,
                    paddingBottom: theme('spacing.4'),
                    marginBottom: theme('spacing.4'),
                },

                // Badge components
                '.badge': {
                    display: 'inline-flex',
                    alignItems: 'center',
                    padding: `${theme('spacing.1')} ${theme('spacing.3')}`,
                    fontSize: theme('fontSize.xs'),
                    fontWeight: theme('fontWeight.medium'),
                    borderRadius: theme('borderRadius.full'),
                    textTransform: 'uppercase',
                    letterSpacing: theme('letterSpacing.wide'),
                },
                '.badge-primary': {
                    backgroundColor: theme('colors.primary.100'),
                    color: theme('colors.primary.800'),
                },
                '.badge-success': {
                    backgroundColor: theme('colors.success.100'),
                    color: theme('colors.success.800'),
                },
                '.badge-warning': {
                    backgroundColor: theme('colors.warning.100'),
                    color: theme('colors.warning.800'),
                },
                '.badge-danger': {
                    backgroundColor: theme('colors.danger.100'),
                    color: theme('colors.danger.800'),
                },

                // Form components
                '.form-input': {
                    borderColor: theme('colors.secondary.300'),
                    borderRadius: theme('borderRadius.lg'),
                    '&:focus': {
                        borderColor: theme('colors.primary.500'),
                        boxShadow: `0 0 0 3px ${theme('colors.primary.100')}`,
                    },
                },
                '.form-select': {
                    borderColor: theme('colors.secondary.300'),
                    borderRadius: theme('borderRadius.lg'),
                    '&:focus': {
                        borderColor: theme('colors.primary.500'),
                        boxShadow: `0 0 0 3px ${theme('colors.primary.100')}`,
                    },
                },

                // Table components
                '.table': {
                    width: '100%',
                    textAlign: 'left',
                    fontSize: theme('fontSize.sm'),
                },
                '.table th': {
                    backgroundColor: theme('colors.secondary.50'),
                    padding: `${theme('spacing.3')} ${theme('spacing.4')}`,
                    fontWeight: theme('fontWeight.semibold'),
                    color: theme('colors.secondary.900'),
                    borderBottom: `1px solid ${theme('colors.secondary.200')}`,
                },
                '.table td': {
                    padding: `${theme('spacing.4')} ${theme('spacing.4')}`,
                    borderBottom: `1px solid ${theme('colors.secondary.100')}`,
                },
                '.table tbody tr:hover': {
                    backgroundColor: theme('colors.secondary.25'),
                },
            });

            // Custom utilities
            addUtilities({
                '.text-gradient': {
                    background: `linear-gradient(135deg, ${theme('colors.primary.600')}, ${theme('colors.primary.400')})`,
                    WebkitBackgroundClip: 'text',
                    WebkitTextFillColor: 'transparent',
                },
                '.bg-gradient-primary': {
                    background: `linear-gradient(135deg, ${theme('colors.primary.600')}, ${theme('colors.primary.400')})`,
                },
                '.scrollbar-hide': {
                    '-ms-overflow-style': 'none',
                    'scrollbar-width': 'none',
                    '&::-webkit-scrollbar': {
                        display: 'none',
                    },
                },
            });
        },
    ],
};