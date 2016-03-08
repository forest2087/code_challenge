var path = require("path"),
    root = path.join(__dirname, "..");

module.exports = {
    test: {
        unit: {
            phpunit: path.join(root, "vendor", "bin", "phpunit"),
            suite: path.join(root, "phpunit.xml"),
            coverage: {
                clover: path.join(root, "reports", "coverage", "clover", "xunit.xml"),
                html: path.join(root, "reports", "coverage", "html"),
                junit: path.join(root, "reports", "junit", "unit.xml")
            }
        }
    }
};
