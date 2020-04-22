import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import _ from 'lodash';


class TagCreate extends Component {

    constructor(props) {
        super(props);

        this.state = {
            content: [
                {
                    'title': '',
                    'include': true,
                }
            ]
        }
    }

    handleChangeTag = (e) => {
        let title = e.target.value;
        let {content} = this.state;
        content.title = title;
        this.setState({content})
    };

    addTag = () => {
        let {content} = this.state;
        let tag = {

        }
    };

    render() {
       return ( <div className="an-tes">
               <div className="form-add-tag">
                   <input type="text"
                          className="form-control"
                          onChange={(e) => this.handleChangeTag(e)}
                          placeholder="Nhập từ khóa..." />
                   <i
                       className="fa fa-plus-circle"
                       aria-hidden="true"
                       style={{
                           color: 'green',
                           fontSize: '16px',
                           cursor: 'pointer',
                           position: 'absolute',
                           right: '-5px',
                           top: '18px'
                       }}
                   ></i>
               </div>
                </div>
       ) }
}

export default TagCreate;

if (document.getElementById('TagCreate')) {

    const element = document.getElementById('TagCreate')

    const props = Object.assign({}, element.dataset)

    ReactDOM.render(
        <TagCreate {...props}/>,
        element
    );
}