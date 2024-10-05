from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_absolute_error, mean_squared_error
from sklearn.model_selection import train_test_split

# قراءة البيانات وتدريب النموذج عند بدء التشغيل
file_path = "C:/xampp/htdocs/educational_institute/dataset/students_data_nd.xlsx"
df = pd.read_excel(file_path)

X = df[['quiz1', 'quiz2', 'midterm']]
y = df['final_score']

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

model = RandomForestRegressor(n_estimators=100, random_state=42)
model.fit(X_train, y_train)


# حساب الدقة باستخدام مجموعة الاختبار
y_pred = model.predict(X_test)
mae = mean_absolute_error(y_test, y_pred)  # خطأ متوسط مطلق
mse = mean_squared_error(y_test, y_pred)    # خطأ مربع متوسط
accuracy = (100 - (mae / np.mean(y_test) * 100)) * 1.0  # حساب دقة التنبؤ كنسبة

app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict_score():
    # استلام البيانات من الطلب
    data = request.json
    quiz1 = data.get('quiz1')
    quiz2 = data.get('quiz2')
    midterm = data.get('midterm')

    # التحقق من صحة البيانات
    if quiz1 is None or quiz2 is None or midterm is None:
        return jsonify({'error': 'Invalid input, all fields are required'}), 400

    # إعداد بيانات الطالب الجديد
    new_student = pd.DataFrame({
        'quiz1': [quiz1],
        'quiz2': [quiz2],
        'midterm': [midterm]
    })

    # التنبؤ بالعلامة النهائية
    predicted_score = model.predict(new_student)[0]

    # تحليل الأداء الشخصي
    quiz_avg = (quiz1 + quiz2) / 2
    performance_analysis = {
        'quiz_average': quiz_avg,
        'midterm': midterm,
        'final_score_predicted': predicted_score,
        'quiz_to_midterm_difference': midterm - quiz_avg,
        'midterm_to_final_difference': predicted_score - midterm,
        
    }

    # تحديد التحسن أو التراجع
    if performance_analysis['quiz_to_midterm_difference'] > 0:
        performance_analysis['quiz_midterm_trend'] = "تحسن"
    else:
        performance_analysis['quiz_midterm_trend'] = "تراجع"

    if performance_analysis['midterm_to_final_difference'] > 0:
        performance_analysis['midterm_final_trend'] = "تحسن"
    else:
        performance_analysis['midterm_final_trend'] = "تراجع"

    return jsonify({
        'predicted_final_score': predicted_score,
        'prediction_accuracy': accuracy ,  # إضافة الدقة إلى التحليل
        'performance_analysis': performance_analysis
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)