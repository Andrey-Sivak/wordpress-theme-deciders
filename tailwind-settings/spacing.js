const spacingValues = {};
const step = 0.25;

for (let i = 1; i <= 250; i += step) {
	spacingValues[`${i}`] = `${i * step}rem`;
}

module.exports = spacingValues;
