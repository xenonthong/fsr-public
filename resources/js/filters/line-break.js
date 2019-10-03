/**
 * Appends line break either before or after value
 *
 * @param value
 * @param {boolean} after
 * @return {string}
 */
export default function (value, after = true) {
    if (!value) return;

    if (after) return `${value}\n`;

    return `\n${value}`;
}