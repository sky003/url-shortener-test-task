import React from 'react';
import {
  withStyles,

  Grid,
  Typography,
  TextField,
  Button,
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
    maxWidth: 1280,
  },
  form: {
    marginTop: 50,
  },
  shortUrl: {
    marginTop: 100,
  },
});

class IndexPage extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      longUrl: null,
      shortUrl: null,
      expiredAt: null,
    };
  }

  handleChange = name => event => {
    this.setState({
      [name]: event.target.value,
    });
  };

  handleSubmit = () => {
    axios
      .post(
        '/api/v1/urls',
        {
          longUrl: this.state.longUrl,
          expiredAt: this.state.expiredAt,
        }
      )
      .then(response => {
        this.setState({
          shortUrl: response.data.shortUrl,
        });
      })
      .catch(error => {
        console.error(error);
      });

  };

  render() {
    const {
      classes,
    } = this.props;

    return (
      <Grid container className={classes.root}>
        <Grid item xs={12} className={classes.container}>
          <Grid container>
            <Grid item xs={12}>

              <Typography variant="display4" align="center">URL Shortener</Typography>

              <form className={classes.form}>
                <Grid container spacing={8}>
                  <Grid item xs={12} md={10}  >
                    <TextField
                      autoFocus
                      id="input-url"
                      label="URL"
                      InputLabelProps={{
                        shrink: true,
                      }}
                      placeholder="https://example.com"
                      helperText="Paste URL you would like to make shorter"
                      fullWidth
                      margin="normal"
                      onChange={this.handleChange('longUrl')}
                    />
                  </Grid>
                  <Grid item xs={12} md={2}>
                    <TextField
                      id="input-expired-at"
                      label="Expired At"
                      type="datetime-local"
                      InputLabelProps={{
                        shrink: true,
                      }}
                      helperText="Short URL will be expired at"
                      margin="normal"
                      onChange={this.handleChange('expiredAt')}
                    />
                  </Grid>
                  <Grid container justify="center">
                    <Button variant="contained" size="large" color="primary" onClick={this.handleSubmit}>Make Shorter</Button>
                  </Grid>
                </Grid>
              </form>
              {this.state.shortUrl && (
                <div className={classes.shortUrl}>
                  <Typography variant="caption" align="center" gutterBottom>Your short URL</Typography>
                  <Typography variant="display2" align="center">{this.state.shortUrl}</Typography>
                </div>
              )}

            </Grid>
          </Grid>
        </Grid>
      </Grid>
    );
  }
}

export default withStyles(styles)(IndexPage);