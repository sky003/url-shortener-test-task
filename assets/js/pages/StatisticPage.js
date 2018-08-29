import React from 'react';
import PropTypes from 'prop-types';
import {
  withStyles,

  Grid,
  Typography,
  Paper,
  Toolbar,
  Table,
  TableHead,
  TableRow,
  TableBody,
  TableCell,
} from '@material-ui/core';
import axios from 'axios';

const styles = theme => ({
  root: {
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
  },
  container: {
    flexGrow: 1,
    maxWidth: 1920,
  },
});

class StatisticPage extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      stats: null,
    };
  }

  componentDidMount() {
    const {
      match,
    } = this.props;

    axios
      .get('/api/v1/urls/' + match.params.shortId + '/stats')
      .then(response => {
        this.setState({
          stats: response.data,
        });
      })
      .catch(error => {
        console.error(error);
      });
  }

  render() {
    const {classes} = this.props;
    const {stats} = this.state;

    return (
      <Grid container className={classes.root}>
        <Grid item xs={12} className={classes.container}>
          <Grid container>
            <Grid item xs={12}>

              <Typography variant="display4" align="center">URL Statistics</Typography>

              {stats && (
                <React.Fragment>

                  <Typography variant="headline" gutterBottom>
                    You have <u>{stats.clicks}</u> {stats.clicks !== 1 ? 'clicks' : 'click'} on original URL <a href={stats.longUrl} target="_blank">{stats.longUrl}</a>
                  </Typography>

                  <Paper>
                    <Toolbar>
                      <Typography variant="title">Click details</Typography>
                    </Toolbar>
                    <Table>
                      <TableHead>
                        <TableRow>
                          <TableCell>Agent</TableCell>
                          <TableCell>Referer</TableCell>
                          <TableCell>Country</TableCell>
                          <TableCell>Date</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>
                        {stats.clientStatistics.map(row => {
                          return (
                            <TableRow key={row.id}>
                              <TableCell component="th" scope="row">
                                {row.userAgent}
                              </TableCell>
                              <TableCell>{row.referer}</TableCell>
                              <TableCell>{row.country}</TableCell>
                              <TableCell>{row.date}</TableCell>
                            </TableRow>
                          );
                        })}
                      </TableBody>
                    </Table>
                  </Paper>

                </React.Fragment>
              )}

            </Grid>
          </Grid>
        </Grid>
      </Grid>
    );
  }
}

StatisticPage.propTypes = {
  classes: PropTypes.object.isRequired,

  match: PropTypes.shape({
    params: PropTypes.shape({
      shortId: PropTypes.string.isRequired,
    }),
  }),
};

export default withStyles(styles)(StatisticPage);