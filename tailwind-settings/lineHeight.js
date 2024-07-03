const lineHeightValues = {};
const step = 0.1;

for (let i = 1; i <= 2.6; i += step) {
	const value = Number(i.toFixed(1));
	lineHeightValues[value] = `${value}`;
}

module.exports = lineHeightValues;
