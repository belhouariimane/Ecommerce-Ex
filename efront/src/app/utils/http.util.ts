import {HttpParams} from '@angular/common/http';


export class HttpUtil {


  public static convertObjectToHttpParams(object:any) {
    if (!object) {
      return null;
    }
    let target: HttpParams = new HttpParams();
    Object.keys(object).forEach((key: string) => {
      const value: string | number | boolean | Date | any = object[key];

      if (value instanceof Date) {
        target = target.append(key, value.toISOString());
      } else if (Array.isArray(value)) {
        value.forEach((item) => {
          target = target.append(`${key.toString()}[]`, item);
        });
      } else if ((typeof value !== 'undefined') && (value !== '') && (value !== null) && !(value instanceof Date)) {
        target = target.append(key, value.toString());
      }
    });
    return target;
  }

}
