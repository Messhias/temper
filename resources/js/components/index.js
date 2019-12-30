import React from 'react';
import ReactDOM from 'react-dom';

// importing the default css
import "../../sass/app.scss";

function App() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;

console.log("aqui");
if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}