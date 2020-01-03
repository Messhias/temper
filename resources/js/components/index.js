import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Highcharts from 'highcharts';
import HighchartsReact from 'highcharts-react-official';

// importing the requests.
import Requests from './requests';

// importing the components.
import WeeklyRetention from './Charts/WeeklyRetention';

export default class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
        };

        this.fetchReportData();
    }

    fetchReportData() {
        Requests.Reports.Get()
            .then(response => {
                const {
                    status = 500,
                } = response;
                if (status === 200) {
                    const { data = false } = response.data;
                    if (data) {
                        this.setState({
                            data: data,
                        });
                    }
                }
            })
            .catch(error => console.error(error));
    }

    static mountWeeklyRetentionGraph(data = false) {
        if (!data) {
            return (
                <p>
                    So far no reports found.
                </p>
            )
        } else {
            return (
                <WeeklyRetention
                    report={data}
                />
            );
        }
    }

    render() {
        const {
            data = [],
        } = this.state;

        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-body">
                                {App.mountWeeklyRetentionGraph(data)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
