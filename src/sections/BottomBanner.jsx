import { useState } from "react";
import { SendIcon } from "lucide-react";

export default function BottomBanner() {
    const [formData, setFormData] = useState({
        nombre: '',
        email: '',
        telefono: '',
        mensaje: ''
    });
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitStatus, setSubmitStatus] = useState(null);

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        setSubmitStatus(null);

        try {
            const response = await fetch('contacto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData)
            });

            const result = await response.json();
            
            if (result.success) {
                setSubmitStatus({ type: 'success', message: '¡Gracias! Tu mensaje ha sido enviado correctamente.' });
                setFormData({ nombre: '', email: '', telefono: '', mensaje: '' });
            } else {
                setSubmitStatus({ type: 'error', message: result.message || 'Hubo un error al enviar el mensaje. Por favor, intenta nuevamente.' });
            }
        } catch (error) {
            setSubmitStatus({ type: 'error', message: 'Error de conexión. Por favor, intenta nuevamente más tarde.' });
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <div className="border-y border-dashed border-slate-200 w-full max-w-5xl mx-auto mt-28 px-6 md:px-16">
            <div className="flex flex-col md:flex-row text-center md:text-left items-center justify-between gap-8 px-3 md:px-10 border-x border-dashed border-slate-200 py-20 -mt-10 -mb-10 w-full">
                <div className="flex-1">
                    <h2 className="text-2xl font-semibold mb-4">¿Tienes alguna consulta?</h2>
                    <p className="text-lg text-slate-600 max-w-md">Contáctanos y te responderemos a la brevedad.</p>
                </div>
                <form onSubmit={handleSubmit} className="flex-1 w-full max-w-md space-y-4">
                    <div>
                        <input
                            type="text"
                            name="nombre"
                            placeholder="Nombre completo"
                            value={formData.nombre}
                            onChange={handleChange}
                            required
                            className="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                        />
                    </div>
                    <div>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            value={formData.email}
                            onChange={handleChange}
                            required
                            className="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                        />
                    </div>
                    <div>
                        <input
                            type="tel"
                            name="telefono"
                            placeholder="Teléfono (opcional)"
                            value={formData.telefono}
                            onChange={handleChange}
                            className="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                        />
                    </div>
                    <div>
                        <textarea
                            name="mensaje"
                            placeholder="Mensaje"
                            value={formData.mensaje}
                            onChange={handleChange}
                            required
                            rows="4"
                            className="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent resize-none"
                        ></textarea>
                    </div>
                    {submitStatus && (
                        <div className={`p-3 rounded-md ${submitStatus.type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>
                            {submitStatus.message}
                        </div>
                    )}
                    <button
                        type="submit"
                        disabled={isSubmitting}
                        className="w-full flex items-center justify-center gap-2 rounded-md py-3 px-5 bg-indigo-600 hover:bg-indigo-700 transition text-white disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <SendIcon size={20} />
                        <span>{isSubmitting ? 'Enviando...' : 'Enviar mensaje'}</span>
                    </button>
                </form>
            </div>
        </div>
    );
}