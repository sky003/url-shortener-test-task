import React from 'react';
import {Route, Switch} from 'react-router-dom';
import IndexPage from './pages/IndexPage';
import StatisticPage from './pages/StatisticPage';

import '../css/app.css';

class App extends React.Component {
  render() {
    return (
      <Switch>
        <Route path="/" component={IndexPage} />
        <Route path="/{shortId}/stats" component={StatisticPage} />
      </Switch>
    );
  }
}

export default App;