var smartgrid = require('smart-grid');

settings = {
  outputStyle: 'scss',
  columns: 12,
  offset: "30px",

  container: {
    maxWidth: "1170px",
    fields: "20px"
  },

  breakPoints: {
    big: {
      width: "1800px"
    },
    xxxl: {
      width: "1600px"
    },
    xxl: {
      width: "1400px"
    },
    xl: {
      width: "1200px"
    },
    lg: {
      width: "992px",
    },
    md: {
      width: "768px",
    },
    sm: {
      width: "576px"
    },
    xs: {
      width: "400px"
    },
  },
};

smartgrid('./src/scss', settings);