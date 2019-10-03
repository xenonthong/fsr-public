import moment from 'moment';

export default function (value, format = 'DD MMM YYYY') {
    if (value) return moment(value).format(format);
}