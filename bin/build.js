const esbuild = require("esbuild");
const fs = require("fs");
const path = require("path");
const shouldWatch = process.argv.includes("--watch");

// Common build options
const commonOptions = {
    sourcemap: "external",
    define: {
        "process.env.NODE_ENV": shouldWatch ? `'development'` : `'production'`,
    },
    bundle: true,
    platform: "browser",
    mainFields: ["module", "main"],
    minifySyntax: true,
    minifyWhitespace: true,
};

// Ensure output directory exists
function ensureDirectoryExists(filePath) {
    const dirname = path.dirname(filePath);
    if (!fs.existsSync(dirname)) {
        fs.mkdirSync(dirname, { recursive: true });
    }
}

async function buildWithWatch(options) {
    try {
        // Ensure output directory exists
        ensureDirectoryExists(options.outfile);

        if (shouldWatch) {
            const ctx = await esbuild.context(options);
            await ctx.watch();
            console.log(`Watching ${options.entryPoints}...`);
            return ctx;
        } else {
            const result = await esbuild.build(options);
            console.log(`Built ${options.entryPoints}`);
            return result;
        }
    } catch (error) {
        console.error(`Build failed for ${options.entryPoints}:`, error);
        throw error;
    }
}

// Main build
buildWithWatch({
    ...commonOptions,
    entryPoints: [`resources/js/index.js`],
    outfile: `dist/index.js`,
}).catch((error) => {
    console.error("Main build failed:", error);
    process.exit(1);
});

// Component builds
const formComponents = [
    "filament-google-geocomplete",
    "filament-google-maps",
    "filament-google-maps-widget",
    "filament-google-maps-entry",
];

formComponents.forEach((component) => {
    buildWithWatch({
        ...commonOptions,
        platform: "neutral", // Override platform for components
        entryPoints: [`resources/js/${component}.js`],
        outfile: `dist/cheesegrits/filament-google-maps/${component}.js`,
    }).catch((error) => {
        console.error(`Component build failed for ${component}:`, error);
        process.exit(1);
    });
});
