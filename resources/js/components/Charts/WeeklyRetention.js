/**
 * @file     WeeklyRetention.js
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    03/01/2020
 * @version  1.0
 */
import React from "react";

import HighchartsReact from "highcharts-react-official";
import Highcharts from "highcharts";

import { filterArray } from '../utils/Functions';

/**
 * mount the chart options data
 * @param data
 * @returns {{yAxis: {title:
 * {text: [string, string, string, string, string]}},
 * xAxis: {accessibility: {rangeDescription: string}},
 * legend: {layout: string, verticalAlign: string, navigation: {
 * style: {position: string}},
 * maxHeight: number, align: string, enabled: boolean}, series: [],
 * responsive: {rules: [{chartOptions: {legend: {layout: string, verticalAlign: string, align: string}},
 * condition: {maxWidth: number}}]}, title: {text: string}}}
 */
function mountOptions(data) {
    return {
        title: {
            text: 'WEEKLY RETENTION CURVES - MIXPANEL DATA',
        },

        yAxis: {
            title: {
                text: ["0%", "25%", "50%", "75%", "100%"]
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'WEEKLY RETENTION CURVES - MIXPANEL DATA'
            }
        },

        legend: {
            maxHeight: 60,
            enabled: true,
            align: 'left',
            verticalAlign: 'top',
            layout: 'horizontal',
            navigation: {
                style: {
                    position: "right"
                }
            }
        },

        series: series(data),

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'top',
                        verticalAlign: 'top',
                    }
                }
            }]
        }
    }
}

/**
 * Create the series function to be show on the chart data.
 *
 * @param data
 * @returns {[]}
 */
function series(data = false) {

    const seriesResult = [];

    for (const [key, value] of Object.entries(data)) {
        const seriesData = filterArray(value.map(val => parseInt(val.onboarding_perentage)));

        seriesResult.push({
            name: key,
            data: Array.from(
                new Set(
                    seriesData.sort((a,b) => b - a)
                )
            ),
        });
    }

    return seriesResult;
}

/**
 * Return the chart mounted accordingly with the specifications.
 *
 * @stateless
 * @param props
 * @returns {*}
 */
export default props => (
    <HighchartsReact
        highcharts={Highcharts}
        options={mountOptions(props.report)}
        allowChartUpdate = { true }
        immutable = { false }
        updateArgs = { [true, true, true] }
        containerProps = {{ className: 'chartContainer' }}
    />
)
