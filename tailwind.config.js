/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./partials/**/*.php",
    "./assets/js/**/*.js"
  ],

  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        sm: "2rem",
        lg: "3rem",
        xl: "4rem",
      },
    },

    extend: {
      fontFamily: {
        heading: ["Montserrat", "sans-serif"],
        body: ["Open Sans", "sans-serif"],
      },

      colors: {
        primary: "#22577A",
        secondary: "#38A3A5",
        accent: "#57CC99",
        soft: "#80ED99",
        light: "#C7F9CC",
        dark: "#0F172A",
        neutral: "#1E293B",
      },

      backgroundImage: {
        "gradient-primary": "linear-gradient(90deg, #22577A, #38A3A5)",
        "gradient-light": "linear-gradient(90deg, #57CC99, #C7F9CC)",
        "parallax-hero": "url('../images/hero-bg.jpg')",
      },

      boxShadow: {
        soft: "0 4px 20px rgba(0, 0, 0, 0.1)",
        hard: "0 8px 40px rgba(0, 0, 0, 0.25)",
      },

      //  ANIMACIONES Y KEYFRAMES COMPLETAS
      keyframes: {
        fadeIn: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
        fadeOut: {
          "0%": { opacity: 1 },
          "100%": { opacity: 0 },
        },
        slideUp: {
          "0%": { transform: "translateY(40px)", opacity: 0 },
          "100%": { transform: "translateY(0)", opacity: 1 },
        },
        slideDown: {
          "0%": { transform: "translateY(-40px)", opacity: 0 },
          "100%": { transform: "translateY(0)", opacity: 1 },
        },
        slideLeft: {
          "0%": { transform: "translateX(40px)", opacity: 0 },
          "100%": { transform: "translateX(0)", opacity: 1 },
        },
        slideRight: {
          "0%": { transform: "translateX(-40px)", opacity: 0 },
          "100%": { transform: "translateX(0)", opacity: 1 },
        },
        zoomIn: {
          "0%": { transform: "scale(0.95)", opacity: 0 },
          "100%": { transform: "scale(1)", opacity: 1 },
        },
        zoomOut: {
          "0%": { transform: "scale(1.05)", opacity: 1 },
          "100%": { transform: "scale(1)", opacity: 0 },
        },
        float: {
          "0%, 100%": { transform: "translateY(0px)" },
          "50%": { transform: "translateY(-12px)" },
        },
        rotateIn: {
          "0%": { transform: "rotate(-180deg)", opacity: 0 },
          "100%": { transform: "rotate(0deg)", opacity: 1 },
        },
        blurIn: {
          "0%": { filter: "blur(12px)", opacity: 0 },
          "100%": { filter: "blur(0)", opacity: 1 },
        },
      },

      animation: {
        fadeIn: "fadeIn 1s ease-in-out both",
        fadeOut: "fadeOut 1s ease-in-out both",
        slideUp: "slideUp 1.2s ease-out both",
        slideDown: "slideDown 1.2s ease-out both",
        slideLeft: "slideLeft 1s ease-out both",
        slideRight: "slideRight 1s ease-out both",
        zoomIn: "zoomIn 0.8s ease-out both",
        zoomOut: "zoomOut 0.8s ease-in both",
        float: "float 3s ease-in-out infinite",
        rotateIn: "rotateIn 1s ease-out both",
        blurIn: "blurIn 1.2s ease-in-out both",
      },

      transitionTimingFunction: {
        "in-expo": "cubic-bezier(0.95, 0.05, 0.795, 0.035)",
        "out-expo": "cubic-bezier(0.19, 1, 0.22, 1)",
      },
    },
  },

  //  Variants para animaciones seguras
  variants: {
    extend: {
      animation: ["motion-safe", "motion-reduce", "hover", "group-hover"],
      translate: ["motion-safe"],
      opacity: ["motion-safe"],
    },
  },

  plugins: [],
};
