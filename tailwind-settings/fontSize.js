const fontSizeValues = {};
const step = 2;

for (let i = 10; i <= 60; i += step) {
	fontSizeValues[`${i}`] = `${i}px`;
}

module.exports = fontSizeValues;
