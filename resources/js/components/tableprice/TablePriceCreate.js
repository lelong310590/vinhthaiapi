import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import _ from 'lodash';

class TablePriceCreate extends Component {

    constructor(props) {
        super(props);

        this.state = {
            content: [
                {
                    'title': '',
                    'description': '',
                    'include': true,
                }
            ]
        }
    }

    componentDidMount = () => {
        if (!_.isNil(this.props.content)) {
            let content = JSON.parse(this.props.content);
            this.setState({content})
        }
    };

    addContent = () => {
        let {content} = this.state;
        let blank = {
            'title': '',
            'include': true,
        };

        content.push(blank);
        this.setState({content});
    };

    handleChangeTitle = (e, idx) => {
        let title = e.target.value;
        let {content} = this.state;
        content[idx].title = title;
        this.setState({content})
    };

    handleChangeInclude = (e, idx) => {
        let include = e.target.checked;
        let {content} = this.state;
        content[idx].include = include;
        this.setState({content})
    }

    handleChangeDescription = (e, idx) => {
        let description = e.target.value;
        let {content} = this.state;
        content[idx].description = description;
        this.setState({content})
    }

    removeItem = (e, idx) => {
        let {content} = this.state;
        content.splice(idx, 1)
        this.setState({content});
    };

    render() {

        let {content} = this.state;

        return (
            <div className="col-xs-12">

                <input type="hidden" value={JSON.stringify(content)} name="content"/>

                <div className="form-group">
                    <label htmlFor="fullname">Nội dung</label>
                    <div className="price-table-content-wrapper">
                        {_.map(content, (c, idx) => {

                            let no = idx + 1;

                            if (no <= 9) {
                                no = '0' + no;
                            }

                            return (
                                <div className="price-table-content-item" key={idx} style={content.length > 1 ? {marginBottom: '15px'} : {}}>
                                    <div className="price-table-content-item-no">
                                        {no}
                                    </div>
                                    <div className="price-table-content-text">
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={c.title}
                                            onChange={(e) => this.handleChangeTitle(e, idx)}
                                            style={c.include ? {} : {textDecoration: 'line-through'}}
                                        />

                                        <div className="price-table-content-description" style={{marginTop: 15}}>
                                            <label>Miêu tả</label>
                                            <textarea
                                                className="form-control"
                                                value={_.has(c, 'description') ? c.description : ''}
                                                onChange={(e) => this.handleChangeDescription(e, idx)}
                                                rows={5}
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div className="price-table-content-action">
                                        <div className="checkbox">
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    checked={c.include}
                                                    onChange={(e) => this.handleChangeInclude(e, idx)}
                                                />
                                                {c.include ? (
                                                    <Fragment>Bao gồm</Fragment>
                                                ) : (
                                                    <Fragment>Không bao gồm</Fragment>
                                                )}
                                            </label>
                                        </div>
                                        {content.length === idx + 1 &&
                                            <i
                                                className="fa fa-plus-circle"
                                                aria-hidden="true"
                                                style={{
                                                    color: 'green',
                                                    fontSize: '16px',
                                                    cursor: 'pointer'
                                                }}
                                                onClick={this.addContent}
                                            ></i>
                                        }

                                        {idx + 1 < content.length &&
                                            <i
                                                className="fa fa-minus-circle"
                                                aria-hidden="true"
                                                style={{color: 'red', fontSize: '16px', cursor: 'pointer'}}
                                                onClick={(e) => this.removeItem(e, idx)}
                                            ></i>
                                        }
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>
            </div>
        )
    }
}

export default TablePriceCreate;

if (document.getElementById('TablePriceCreate')) {

    const element = document.getElementById('TablePriceCreate')

    const props = Object.assign({}, element.dataset)

    ReactDOM.render(
        <TablePriceCreate {...props}/>,
        element
    );
}